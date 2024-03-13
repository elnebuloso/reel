use clap::{Command, Arg};

pub fn fetch_subcommands() -> Result<Vec<Command>, Box<dyn std::error::Error>> {
    let commands =     vec![
        Command::new("subcommand1")
            .about("Tut etwas Spezifisches mit subcommand1"),
        Command::new("subcommand2")
            .about("Tut etwas Spezifisches mit subcommand2")
    ];

    Ok(commands)
}
