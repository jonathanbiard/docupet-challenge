insert into pet_type (id, name) values (1, 'Cat');
insert into pet_type (id, name) values (2, 'Dog');


insert into breed (id, pet_type, name, is_dangerous) values (1, 1, 'Siamese', false);
insert into breed (id, pet_type, name, is_dangerous) values (2, 1, 'Persian', false);
insert into breed (id, pet_type, name, is_dangerous) values (3, 1, 'House', false);
insert into breed (id, pet_type, name, is_dangerous) values (4, 1, 'Tiger', true);

insert into breed (id, pet_type, name, is_dangerous) values (5, 2, 'Golden Retriever', false);
insert into breed (id, pet_type, name, is_dangerous) values (6, 2, 'Border Collie', false);
insert into breed (id, pet_type, name, is_dangerous) values (7, 2, 'Labrador', false);
insert into breed (id, pet_type, name, is_dangerous) values (8, 2, 'Wolf', true);


insert into pet (breed, name, age, birthday, gender) values (3, 'Luvia', 3, null, 'female');
insert into pet (breed, name, age, birthday, gender) values (6, 'Suki', null, '2021-04-03', 'female');
insert into pet (breed, name, age, birthday, gender) values (4, 'Teeth', 5, null, 'male');
insert into pet (breed, name, age, birthday, gender) values (8, 'Claws', 6, null, 'male');
