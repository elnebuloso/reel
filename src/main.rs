mod reel_init;

use clap::{Arg, Command};
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

    // match matches.subcommand() {
    //     Some(("patch", sub_matches)) => {
    //         let gitlab_host = sub_matches.get_one::<String>("gitlab_host").unwrap();
    //         let gitlab_token = sub_matches.get_one::<String>("gitlab_token").unwrap();
    //         let project_name = sub_matches.get_one::<String>("project_name").unwrap();
    //         let source_filename = sub_matches.get_one::<String>("source_filename").unwrap();
    //         let patch_filename = sub_matches.get_one::<String>("patch_filename").unwrap();
    //         let branch = sub_matches.get_one::<String>("branch").unwrap();
    //         let message = sub_matches.get_one::<String>("message").unwrap();
    //         let update_yaml = sub_matches.get_one::<String>("update_yaml").unwrap();
    //         let create_patch_content = sub_matches.get_one::<bool>("create_patch_content").unwrap();

    //         let bibo_patch_config = bibo_patch::Config::builder()
    //             .gitlab_host(gitlab_host)
    //             .gitlab_token(gitlab_token)
    //             .project_name(project_name)
    //             .source_filename(source_filename)
    //             .patch_filename(patch_filename)
    //             .branch(branch)
    //             .message(message)
    //             .update_yaml(update_yaml)
    //             .create_patch_content(create_patch_content.clone())
    //             .build()?;

    //         if let Err(e) = bibo_patch::execute(bibo_patch_config) {
    //             log::error!("{}", e.to_string());
    //         }
    //     }
    //     _ => unreachable!(), // If all subcommands are defined above, anything else is unreachable!()
    // }

    Ok(())
}
