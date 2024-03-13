use clap::{Arg, Command};
use serde::{Deserialize, Serialize};
use serde_yaml;
use std::fs::File;
use std::io::Read;
use std::path::Path;
use walkdir::WalkDir;

#[derive(Debug, Serialize, Deserialize)]
struct ReelFile {
    filename: String,
    config: ReelConfig,
}

#[derive(Debug, Serialize, Deserialize)]
struct ReelConfig {
    // Definiere hier die Felder entsprechend deinem YAML-Schema.
}

pub fn fetch_subcommands() -> Result<Vec<Command>, Box<dyn std::error::Error>> {
    let base_path = "./.reel";
    let reel_files = read_yaml_files(base_path)?;

    for file in reel_files {
        println!("{:?}", file);
    }
    
    let commands = vec![
        Command::new("subcommand1").about("Tut etwas Spezifisches mit subcommand1"),
        Command::new("subcommand2").about("Tut etwas Spezifisches mit subcommand2"),
    ];

    Ok(commands)
}

fn read_yaml_files(base_path: &str) -> Result<Vec<ReelFile>, Box<dyn std::error::Error>> {
    let base_path_obj = Path::new(base_path);
    let mut files = Vec::new();

    for entry in WalkDir::new(base_path)
        .into_iter()
        .filter_map(|e| e.ok())
        .filter(|e| e.path().extension().map_or(false, |ext| ext == "yaml" || ext == "yml"))
    {
        let path = entry.path();

        // Ermittle den relativen Pfad der Datei vom Basispfad
        let relative_path = path.strip_prefix(base_path_obj)?.to_str().unwrap();

        let mut file = File::open(path)?;
        let mut contents = String::new();
        file.read_to_string(&mut contents)?;

        // Parse den Inhalt der Datei zu ReelConfig
        let config: ReelConfig = serde_yaml::from_str(&contents)?;

        // Erstelle ein ReelFile-Objekt und füge es zum Vector hinzu
        files.push(ReelFile {
            filename: relative_path.to_string(),
            config,
        });
    }

    Ok(files)
}
