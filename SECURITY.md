# Security

LedgerOne treats posted accounting records as immutable. Do not bypass service-layer validation or database immutability triggers in production.

Report vulnerabilities privately to the repository owner. Do not include production credentials, personal information, tax identifiers, invoice XML, database dumps, or JoFotara credentials in an issue.

Production requirements: HTTPS, `APP_DEBUG=false`, a unique `APP_KEY`, secure session cookies, least-privilege database credentials, encrypted/off-site backups, restricted server access, and a functioning queue worker. JoFotara must remain disabled until credentials and live validation are available.
