FROM alpine:latest
RUN apk add --no-cache bash
EXPOSE 8080
ENV VHOST_IP=1321
ENV VHOST_PATH=3213
ENV SETTINGS="321"
ENTRYPOINT ["sh", "-c", "echo \"Hello from $VHOST_IP with arguments $@\"; while true; do sleep 3600; done"]
