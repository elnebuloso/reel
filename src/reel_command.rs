use crate::reel_init::ReelFile;
use std::process::{Command, Stdio};

pub fn execute(reel_file: &ReelFile) -> Result<(), Box<dyn std::error::Error>> {
    if let Some(scripts) = &reel_file.config.scripts {
        for script in scripts {
            log::debug!("Command: {}, Script: {}", reel_file.name, script);

            let mut child = Command::new("bash")
                .arg("-c")
                .arg(script)
                .stdin(Stdio::inherit())
                .stdout(Stdio::inherit())
                .stderr(Stdio::inherit())
                .spawn()?;

            let status = child.wait()?;

            if !status.success() {
                return Err(format!(
                    "Script execution failed. Command: '{}', Script: '{}'",
                    reel_file.name, script
                )
                .into());
            }
        }
    }

    Ok(())
}
