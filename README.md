# Reel

CI/CD Abstraction (currently under heavy development)

## Development

````shell
dos2unix app.sh \
&& chmod +x app.sh \
&& git update-index --chmod=+x app.sh
````

````shell
docker run --pull always -it -v $(pwd):$(pwd) -w $(pwd) elnebuloso/reel:latest
````
