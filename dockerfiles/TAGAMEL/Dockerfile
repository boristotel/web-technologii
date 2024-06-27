FROM alpine:latest
RUN apk add --no-cache bash
EXPOSE 60006
ENV VHOST_IP=12421341234
ENV VHOST_PATH=1245435412
ENV SETTINGS="ddvaads"
ENTRYPOINT echo 'Hello from $VHOST_IP with arguments ${@}' && tail -f /dev/null
