#!/usr/bin/env bash
docker compose down \
    && docker compose up -d \
    && docker compose exec server bash
