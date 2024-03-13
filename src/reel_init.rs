use clap::Command;
use serde::{Deserialize, Serialize};
use serde_yaml;
use std::fs::File;
use std::io::Read;
use std::path::Path;
use walkdir::WalkDir;

#[derive(Debug, Serialize, Deserialize)]
struct ReelFile {
    name: String,
    filename: String,
    config: ReelConfig,
}

#[derive(Debug, Serialize, Deserialize)]
struct ReelConfig {
    kind: String
}

pub fn fetch_subcommands() -> Result<Vec<Command>, Box<dyn std::error::Error>> {
    let base_path = "./.reel";
    let reel_files = read_yaml_files(base_path)?;
    let mut subcommands = Vec::new();

    for file in reel_files {
        if file.config.kind == "job/v1" {
            subcommands.push(Command::new(file.name));
        }
    }

    Ok(subcommands)
}

fn read_yaml_files(base_path: &str) -> Result<Vec<ReelFile>, Box<dyn std::error::Error>> {
    let base_path_obj = Path::new(base_path);
    let mut reel_files = Vec::new();

    for entry in WalkDir::new(base_path)
        .into_iter()
        .filter_map(|e| e.ok())
        .filter(|e| e.path().extension().map_or(false, |ext| ext == "yaml" || ext == "yml"))
    {
        let path = entry.path();

        // Determine the file's relative path from the base path
        let relative_path = path.strip_prefix(base_path_obj)?.to_str().unwrap();

        let mut file = File::open(path)?;
        let mut contents = String::new();
        file.read_to_string(&mut contents)?;

        // Parse the file's content into ReelConfig
        let config: ReelConfig = serde_yaml::from_str(&contents)?;

        // Generate the name by replacing slashes with colons and removing the file extension
        let name = relative_path
            .rsplitn(2, '.') // Split from the end into 2 parts at the first dot found
            .last() // Take the first part (ignoring the file extension)
            .unwrap()
            .replace("/", ":"); // Replace slashes with colons

        // Create a ReelFile object and add it to the vector
        reel_files.push(ReelFile {
            name,
            filename: relative_path.to_string(),
            config,
        });
    }

    Ok(reel_files)
}
