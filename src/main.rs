mod reel_command;
mod reel_init;
mod reel_setup;
mod reel_update;

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

    app = app.subcommand(Command::new("update").about("Update reel installation to the latest release"));

    app = app.subcommand(Command::new("setup").about("Setup and configure reel in the current project directory"));

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
            if let Err(e) = reel_command::execute(&reel_file) {
                log::error!("{}", e.to_string());
            }

            return Ok(());
        }
    }

    match matches.subcommand() {
        Some(("update", _sub_matches)) => {
            if let Err(e) = reel_update::execute() {
                log::error!("{}", e.to_string());
            }
        }
        Some(("setup", _sub_matches)) => {
            if let Err(e) = reel_setup::execute() {
                log::error!("{}", e.to_string());
            }
        }
        _ => unreachable!(),
    }

    Ok(())
}
