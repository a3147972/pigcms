set @oldhost = '127.0.0.1';
set @newhost = '127.0.0.1';
UPDATE pigcms_slider
SET url = REPLACE(
	url,
	@oldhost,
	@newhost
);

UPDATE pigcms_config
SET value = REPLACE(
	value,
	@oldhost,
	@newhost
);

UPDATE pigcms_diymenu_class
SET url = REPLACE(
	url,
	@oldhost,
	@newhost
);
