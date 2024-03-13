mod reel_init;

use clap::Command;
use env_logger::{Builder as EnvLoggerBuilder, Env as EnvLoggerEnv};

fn main() -> Result<(), Box<dyn std::error::Error>> {
    EnvLoggerBuilder::from_env(EnvLoggerEnv::default().default_filter_or("info")).init();

    let command = Command::new(env!("CARGO_PKG_NAME"))
        .about("CI/CD Abstraction")
        .version(env!("CARGO_PKG_VERSION"))
        .subcommand_required(true)
        .arg_required_else_help(true)
        .subcommands(reel_init::fetch_subcommands()?);

    let _matches = command.get_matches();

    Ok(())
}
