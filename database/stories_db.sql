CREATE TABLE users (
    id_user INTEGER PRIMARY KEY AUTOINCREMENT,
    username VARCHAR NOT NULL,
    password VARCHAR NOT NULL
);
CREATE TABLE stories (
    id_story INTEGER PRIMARY KEY,
    id_user VARCHAR REFERENCES users NOT NULL,
    published DATE NOT NULL,
    title VARCHAR NOT NULL,
    brief_intro VARCHAR NOT NULL,
    storie_text VARCHAR NOT NULL,
    plus VARCHAR REFERENCES users
);
CREATE TABLE comments (
    id_comment INTEGER,
    id_story INTEGER,
    id_user VARCHAR REFERENCES users NOT NULL,
    published DATE NOT NULL,
    comment_text VARCHAR NOT NULL,
    plus VARCHAR REFERENCES users,
    PRIMARY KEY(id_comment, id_story)
);

INSERT INTO users (username, password) VALUES(
    'Ben1',
    '123'
);
INSERT INTO users (username, password) VALUES(
    'Ben2',
    '234'
);
INSERT INTO users (username, password) VALUES(
    'Ben3',
    '345'
);

INSERT INTO stories VALUES(
    1,
    'Ben1',
    '2007-01-01 10:00:00',
    'Lorem ipsum dolor sit amet',
    'Aenean sed euismod risus. Sed laoreet tellus eu sem tempus commodo. Curabitur ultricies mauris vitae enim accumsan sollicitudin.',
    'Phasellus tincidunt ipsum quis libero finibus, quis vulputate neque interdum. Sed et vehicula dui. Vivamus tristique ante at lorem tincidunt fermentum. Aliquam erat volutpat. Cras ut dolor bibendum, viverra sem eget, laoreet mi. Mauris et augue sit amet odio dapibus accumsan. Interdum et malesuada fames ac ante ipsum primis in faucibus. Phasellus vitae quam auctor, mattis nisi vel, sodales ipsum. Ut ac ullamcorper dolor. Cras ultricies risus eget nunc laoreet, vehicula vestibulum felis eleifend. Fusce ornare tortor ante, eu vulputate elit pellentesque at.',
    NULL
);
INSERT INTO stories VALUES(
    2,
    'Ben3',
    '2007-04-05 13:45:12',
    'Proin libero ipsum, porttitor in nunc sit amet',
    'Quisque et quam tempor, tempus augue id, ullamcorper nisl. Class aptent taciti sociosqu ad litora torquent per conubia nostra',
    'Morbi sit amet dignissim nisl. Nam ornare risus eu erat vehicula pretium. Donec ut faucibus ex, nec ultricies nunc. Ut purus felis, vehicula vel elit congue, placerat cursus nunc. Vestibulum gravida orci id ligula placerat, eu pulvinar sem pharetra. Proin pulvinar, ipsum at molestie condimentum, ligula ante cursus ligula, congue blandit ex libero nec ipsum. Donec sit amet tortor hendrerit, mattis est eu, scelerisque nibh. Mauris vitae eros velit. Integer vitae semper mauris. Proin ornare ex quis diam feugiat, a euismod quam fermentum. Nam lobortis ultricies interdum.',
    NULL
);

INSERT INTO comments VALUES(
    1,
    1,
    'Ben2',
    '2007-01-01 12:34:10',
    'Suspendisse vitae nisl lectus. Etiam hendrerit.',
    NULL
);
INSERT INTO comments VALUES(
    2,
    1,
    'Ben1',
    '2007-01-01 12:38:34',
    'Non iaculis nisl dui id augue..',
    NULL
);
INSERT INTO comments VALUES(
    3,
    1,
    'Ben2',
    '2007-01-01 13:12:37',
    'In ultrices diam elit. Aenean nunc eros, dapibus at nisl non, ultrices facilisis purus.',
    NULL
);

INSERT INTO comments VALUES(
    1,
    2,
    'Ben1',
    '2007-04-05 17:34:11',
    'Aliquam eget mauris massa. Vestibulum nisi velit, sollicitudin eu odio quis, fermentum lobortis libero.',
    NULL
);