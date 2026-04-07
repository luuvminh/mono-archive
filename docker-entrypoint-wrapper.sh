#!/bin/bash
# Wrapper entrypoint that fixes Apache MPM conflict before starting WordPress
# Remove conflicting MPM modules at runtime (after WordPress entrypoint copies files)
rm -f /etc/apache2/mods-enabled/mpm_event.load /etc/apache2/mods-enabled/mpm_event.conf
rm -f /etc/apache2/mods-enabled/mpm_worker.load /etc/apache2/mods-enabled/mpm_worker.conf

# Ensure mpm_prefork is enabled
ln -sf /etc/apache2/mods-available/mpm_prefork.load /etc/apache2/mods-enabled/mpm_prefork.load 2>/dev/null
ln -sf /etc/apache2/mods-available/mpm_prefork.conf /etc/apache2/mods-enabled/mpm_prefork.conf 2>/dev/null

# Call the original WordPress entrypoint
exec docker-entrypoint.sh "$@"
