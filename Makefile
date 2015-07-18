validate-schema:
	@./vendor/bin/doctrine-module orm:validate-schema

schema-update:
	@./vendor/bin/doctrine-module orm:schema-tool:update --dump-sql

schema-update-force:
	@./vendor/bin/doctrine-module orm:schema-tool:update --dump-sql --force
restart-services:
	@sudo service httpd restart && sudo service mysqld restart
restart-server:
	@sudo systemctl restart httpd.service
generate-entity:
	@vendor/bin/doctrine-module orm:convert-mapping --filter="$(entity)" --from-database annotation --namespace="Servidor\\Entity\\" module/Servidor/src
generate-entities-test:
	@vendor/bin/doctrine-module orm:convert-mapping --from-database annotation --namespace="Base\\Entity\\" module/Base/src
