create table pet_type
(
    id           tinyint auto_increment,
    name         VARCHAR(3) not null,

    constraint pet_type_pk primary key (id)
);

create unique index pet_type_name_uindex on pet_type (name);



create table breed
(
    id           tinyint auto_increment,
    pet_type     tinyint,
    name         VARCHAR(64) not null,
    is_dangerous boolean default false not null,

    constraint breed_pk primary key (id),
    constraint breed_pet_type_id_fk
        foreign key (pet_type) references pet_type (id)
            on update cascade on delete cascade
);

create unique index breed_name_uindex on breed (name);



create table pet
(
    id           integer auto_increment,
    breed        tinyint,
    name         varchar(128) not null,
    age          tinyint,
    birthday     date,
    gender       enum('male', 'female') not null,

    constraint pet_pk primary key (id),
    constraint pet_breed_id_fk
        foreign key (breed) references breed (id)
            on update cascade on delete cascade
);

create index pet_name_index on pet (name);
create index pet_breed_index on pet (breed);
create index pet_age_index on pet (age);
create index pet_birthday_index on pet (birthday);
create index pet_gender_index on pet (gender);
