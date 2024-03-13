FROM rust:1.76.0-buster as builder
WORKDIR /app

COPY src /app/src
COPY Cargo.toml /app/Cargo.toml
COPY Cargo.lock /app/Cargo.lock

RUN cargo build --release

FROM debian:12.5-slim as prod
WORKDIR /app

COPY --from=builder /app/target/release/reel /usr/local/bin/reel

CMD ["reel"]
