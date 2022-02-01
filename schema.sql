create table users_details
(
    id      serial
        constraint users_details_pk
            primary key,
    name    varchar(100) not null,
    surname varchar(100) not null
);

alter table users_details
    owner to cjsjqhmtuclwvr;

create unique index users_details_id_uindex
    on users_details (id);

create table users_roles
(
    id        serial
        constraint users_roles_pk
            primary key,
    role_name varchar(100) not null
);

alter table users_roles
    owner to cjsjqhmtuclwvr;

create table users
(
    id              serial
        constraint users_pk
            primary key,
    id_user_details integer      not null
        constraint users_users_details_id_fk
            references users_details
            on update cascade on delete cascade,
    id_user_role    integer      not null
        constraint users_users_roles_id_fk
            references users_roles
            on update cascade on delete cascade,
    email           varchar(255) not null,
    password        varchar(255) not null,
    created_at      date         not null
);

alter table users
    owner to cjsjqhmtuclwvr;

create unique index users_id_uindex
    on users (id);

create table snippets
(
    id               serial
        constraint snippets_pk
            primary key,
    id_author        integer      not null
        constraint snippets_users_id_fk
            references users
            on update cascade on delete cascade,
    title            varchar(255) not null,
    description      text,
    instruction      text,
    snippet_filepath varchar(255) not null,
    created_at       date         not null,
    platform         varchar(255) not null
);

alter table snippets
    owner to cjsjqhmtuclwvr;

create unique index snippets_id_uindex
    on snippets (id);

create unique index users_roles_id_uindex
    on users_roles (id);


