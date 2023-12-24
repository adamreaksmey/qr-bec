-- Can be executed after you ran all of the migrations.

-- ESTABLISH A RELATIONSHIP BETWEEN THE USERS AND THEIR RELATIVES.
ALTER TABLE relatives MODIFY COLUMN parentId bigint(20) unsigned NOT NULL;
ALTER TABLE relatives ADD CONSTRAINT relatives_parentid_foreign FOREIGN KEY (parentId) REFERENCES users (id); 