#!/usr/bin/env bash
# Build an installable theme zip in dist/, excluding paths listed in .distignore.
set -euo pipefail
cd "$(dirname "$0")/.."

slug=auto-glass-care
version=$(sed -n 's/^Version: *//p' style.css | tr -d '\r')
out="dist/$slug-$version.zip"
stage=$(mktemp -d)
trap 'rm -rf "$stage"' EXIT

rsync -a --exclude-from=.distignore --exclude=.DS_Store ./ "$stage/$slug/"
mkdir -p dist
rm -f "$out"
(cd "$stage" && zip -qr - "$slug") > "$out"
echo "$out"
