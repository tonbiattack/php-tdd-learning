#!/usr/bin/env bash
set -euo pipefail

root="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
cd "$root"

failures=0
while IFS= read -r -d '' markdown; do
    directory="$(dirname "$markdown")"
    while IFS= read -r target; do
        target="${target%%#*}"
        [[ -z "$target" || "$target" == http://* || "$target" == https://* ]] && continue
        if [[ ! -e "$directory/$target" ]]; then
            printf 'Broken link: %s -> %s\n' "$markdown" "$target" >&2
            failures=1
        fi
    done < <(grep -oP '\]\(\K[^)]+' "$markdown" || true)
done < <(find . -path './vendor' -prune -o -name '*.md' -print0)

if [[ "$failures" -ne 0 ]]; then
    exit 1
fi

printf 'All local Markdown links are valid.\n'
