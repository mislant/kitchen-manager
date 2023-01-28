# syntax=docker/dockerfile:1.4
ARG NGINX_VERSION
FROM nginx:${NGINX_VERSION}-alpine as base

COPY --link .docker/nginx/default.conf /etc/nginx/conf.d/default.conf

FROM base as dev
# Add bash to be able to connect in tty
RUN apk add --no-cache bash
# Non-root nginx config
COPY --link .docker/nginx/dev/nginx.conf /etc/nginx/nginx.conf

# Assign directories for host user
ARG USER_NAME
ARG USER_ID
ARG USER_GID

RUN addgroup -g ${USER_GID} ${USER_NAME} && \
    adduser -DH -G ${USER_NAME} -u ${USER_ID} ${USER_NAME} && \
    mkdir -p /var/cache/nginx && \
    chown -R ${USER_NAME}:${USER_NAME} /var/cache/nginx && \
    chown -R ${USER_NAME}:${USER_NAME} /var/log/nginx && \
    chown -R ${USER_NAME}:${USER_NAME} /etc/nginx

USER ${USER_NAME}

FROM base as prod

COPY --link . /var/www/html/
WORKDIR /var/www/html

RUN chown -R nginx:nginx ./