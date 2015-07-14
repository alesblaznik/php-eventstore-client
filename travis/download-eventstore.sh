#!/bin/bash

function usage {
    >&2 echo "Usage: $0 version"
}

if [ "$#" -ne 1 ]; then
    usage
    exit 2
fi

file="EventStore-OSS-Linux-$1.tar.gz"

if [ ! -f "$HOME/downloads/$file" ]; then
    echo "File $file not cached, downloading..."
    wget "http://download.geteventstore.com/binaries/$file" -O "$HOME/downloads/$file"
else
    echo "File $file found in cache"
fi
