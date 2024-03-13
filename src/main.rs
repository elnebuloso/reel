mod reel_init;

use clap::Command;
use env_logger::{Builder as EnvLoggerBuilder, Env as EnvLoggerEnv};

fn main() -> Result<(), Box<dyn std::error::Error>> {
    EnvLoggerBuilder::from_env(EnvLoggerEnv::default().default_filter_or("info")).init();

    let subcommands_map = reel_init::fetch_subcommands()?;

    let mut app = Command::new(env!("CARGO_PKG_NAME"))
        .about("CI/CD Abstraction")
        .version(env!("CARGO_PKG_VERSION"))
        .subcommand_required(true)
        .arg_required_else_help(true);

    for (name, reel_file) in subcommands_map.iter() {
        let mut subcommand = Command::new(name);

        if let Some(desc) = &reel_file.config.desc {
            subcommand = subcommand.about(desc);
        }

        app = app.subcommand(subcommand);
    }

    let matches = app.get_matches();

    if let Some((name, _)) = matches.subcommand() {
        if let Some(reel_file) = subcommands_map.get(name) {
            if let Some(scripts) = &reel_file.config.scripts {
                for script in scripts {
                    log::info!("{}", script)
                }
            }
        }
    }

    Ok(())
}
