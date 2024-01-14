- create table

```sql
CREATE TABLE [IF NOT EXISTS] tableName (column datatype [NOT NULL|DEFAULT,UNIQUE], ...)
-- CREATE TABLE posts (title VARCHAR(255) NOT NULL, isPublish TINYINT NOT NULL DEFAULT 0)
```

- truncate table

```sql
TRUNCATE TABLE tableName;
-- TRUNCATE TABLE posts;
```

- create column created_at

```sql
CREATE TABLE [IF NOT EXISTS] tableName (column datatype TIMESTAMP DEFAULT NOW())
-- CREATE TABLE posts (created_at TIMESTAMP DEFAULT NOW())
```

- create primary key

```sql
CREATE TABLE tableName (column datatype PRIMARY KEY AUTO_INCREMENT, ...)
-- CREATE TABLE posts (id BIGINT UNSIGNED primary key AUTO_INCREMENT, ...)
```

- drop table

```sql
DROP TABLE tableName -- DROP TABLE post
```

- drop column

```sql
ALTER TABLE tableName DROP COLUMN columnName;
-- ALTER TABLE post DROP COLUMN title
```

- delete row

```sql
DELETE FROM tableName WHERE condition
-- DELETE FROM posts where id = 1
```

- rename table

```sql
RENAME TABLE oldTableName TO newTableName
-- RENAME TABLE posts TO title
```

- rename column

```sql
ALTER TABLE oldTableName CHANGE newTableName datatype
-- ALTER TABLE posts CHANGE title VARCHAR(255)
```

- alter column datatype

```sql
ALTER TABLE tableName MODIFY column VARCHAR(255)
-- ALTER TABLE post MODIFY title VARCHAR(60)
```

- change order of column

```sql
ALTER TABLE tableName MODIFY column varchar(255) AFTER column
-- ALTER TABLE posts MODIFY title varchar(20) AFTER id
```

- add column

```sql
ALTER TABLE tableName
ADD column datatype [FIRST|AFTER existingColumn],
ADD column datatype [FIRST|AFTER existingColumn]
-- ALTER TABLE post
-- ADD title VARCHAR(255) [FIRST|AFTER existingColumn],
-- ADD description VARCHAR(255) [FIRST|AFTER existingColumn],
```

- update row

```sql
UPDATE tableName
SET column1 = value1, column2 = value2,..., columnN = valueN
WHERE [condition];
-- UPDATE posts SET title = 'lorem', isPublish = 1 WHERE id = 1
```

- insert into

```sql
INSERT INTO tableName (column1, column2, column3, ...)
VALUES (value1, value2, value3, ...);
-- INSERT INTO post (title, tags, isPublish) VALUES ('lorem', 'ipsum', 1)
```

- create foreign key

```sql
CREATE TABLE users(
    id BIGINT UNSIGNED PRIMARY KEY auto_increment,
    name VARCHAR (20),
    age INT
);

CREATE TABLE posts (
    ID BIGINT UNSIGNED PRIMARY KEY auto_increment,
    titel VARCHAR(255),
    user_id BIGINT UNSIGNED, -- datatype must be the same as users table id
    CONSTRAINT fk_user FOREIGN KEY(user_id) REFERENCES users(id)
    ON UPDATE CASCADE -- if user id change post_id update automatic
    ON DELETE RESTRICT
);
```

- drop foreign key

```sql
ALTER TABLE tableName DROP FOREIGN KEY (constraint symbol);
-- ALTER TABLE posts DROP FOREIGN KEY fk_user
```

- inner join

```sql
SELECT * FROM tableName1 as u
[INNER] JOIN tableName2 as p ON u.column = p.column
WHERE condidtion
-- SELECT * FROM users as u
-- JOIN posts AS p ON u.id = p.user_id
-- WHERE u.id = 1
```

- group by

| id  | name   | age |
| --- | ------ | --- |
| 1   | Jack   | 32  |
| 2   | Ryan   | 31  |
| 3   | Toad   | 33  |
| 4   | Link   | 32  |
| 5   | Jon    | 33  |
| 6   | Wick   | 31  |
| 7   | Mario  | 32  |
| 8   | Luigi  | 33  |
| 9   | Peach  | 31  |
| 10  | Bowser | 32  |

```sql
SELECT age, count(age) as "#" from users
GROUP BY age
ORDER BY age;
```

| age | #   |
| --- | --- |
| 31  | 4   |
| 32  | 4   |
| 33  | 2   |
