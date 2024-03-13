use serde::{Deserialize, Serialize};
use serde_yaml;
use std::collections::BTreeMap;
use std::fs::File;
use std::io::Read;
use std::path::Path;
use walkdir::WalkDir;

#[derive(Debug, Serialize, Deserialize)]
pub struct ReelFile {
    pub name: String,
    pub filename: String,
    pub config: ReelConfig,
}

#[derive(Debug, Serialize, Deserialize)]
pub struct ReelConfig {
    pub kind: String,
    pub desc: Option<String>,
    pub scripts: Option<Vec<String>>,
}

pub fn fetch_subcommands() -> Result<BTreeMap<String, ReelFile>, Box<dyn std::error::Error>> {
    let base_path = "./.reel";
    let reel_files = read_yaml_files(base_path)?;
    let mut subcommands_map = BTreeMap::new();

    for file in reel_files {
        if file.config.kind == "command/v1" {
            subcommands_map.insert(file.name.clone(), file);
        }
    }

    Ok(subcommands_map)
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
        let relative_path = path.strip_prefix(base_path_obj)?.to_str().unwrap();

        let mut file = File::open(path)?;
        let mut contents = String::new();
        file.read_to_string(&mut contents)?;

        let config: ReelConfig = serde_yaml::from_str(&contents)?;

        let name = relative_path.rsplitn(2, '.').last().unwrap().replace("/", ":");

        reel_files.push(ReelFile {
            name,
            filename: relative_path.to_string(),
            config,
        });
    }

    Ok(reel_files)
}
