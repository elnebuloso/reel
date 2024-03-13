use crate::reel_init::ReelFile;
use std::process::Command;

pub fn execute(reel_file: &ReelFile) -> Result<(), Box<dyn std::error::Error>> {
    if let Some(scripts) = &reel_file.config.scripts {
        for script in scripts {
            log::debug!("Command: {}, Script: {}", reel_file.name, script);

            let output = Command::new("bash").arg("-c").arg(script).output()?;

            if !output.status.success() {
                return Err(format!("{}", String::from_utf8_lossy(&output.stderr)).into());
            }

            println!("{}", String::from_utf8_lossy(&output.stdout));
        }
    }

    Ok(())
}
