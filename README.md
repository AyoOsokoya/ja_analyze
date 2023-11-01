# About
This project is composed of 3 parts.
1. The Laravel API backend responsible for calling the tokenizer, dictionary, and database.
2. The Nuxt frontend responsible for displaying the data and calling the Laravel API. (NodeJS + Kuruomji.js)
3. The tokenizer server responsible for tokenizing the text (Nuxt & Vuetify)

Credit goes to: https://github.com/BayBreezy/nuxt3-vuetify3-starter for the Nuxt3-Vuetify3 frontend starter template. 

# Installation
## Laravel API
- The quickest way to get started is to use Sail. Sail is a docker container that will run the Laravel API.
- Whatever system you are on install docker.
- In the "backend" folder run ```composer install```
- If sail is not installed in the project ```php artisan sail:install```
- Then run ```./vendor/bin/sail up``` to start the docker container.
 
## Tokenization Server
- Run  ```npm i``` inside of the backend folder.
- To run the nodejs server, inside the backend folder run ```sail node kuruomji_server.cjs```

## Nuxt Frontend 
- Run ```npm i``` inside of the Nuxt3-Vuetify3 folder.
- To run the frontend, inside the Nuxt3-Vuetify3 folder run ```sail node run dev```
- The frontend should be running on localhost:3000
 
# Implementation
- In the ```app/Domains/``` folder there are domains "Word" and "Paragraph". I like to organize code in to
- domains to separate the code from the dependencies and make logical groupings of code. This makes refactoring way
- easier as well as testing.
- Each domain has folders like Actions, Enums, Models pertaining to the domain.
- Actions folders are used to code logic from controllers and to enhance testability. 
- A class called WordDto (data transfer object) was created to around Word data in some kind of structure, not as a huge array of data. 
- If there were more time, I probably would have separated this in to smaller parts to more strictly pass around and type check data.

## Models
- There are 3 models, Word, Sense and Reading, with Word having hasMany relationships to both.
- While columns were used for each property of senses, the data of those properties (ie: english_definitions) are stored as JSON.
This is to prevent extreme normalization and joins, which just isn't needed. The JSON transformations are handled by the model $casts property.

## Http Layer
- Http response codes are all contained in an Enum ```EnumHttpResponseStatusCode.php``` for consistency and to prevent magic numbers.
(I made this from scratch and I am going to keep it :))

A piece of custom middleware was used to force output to always be JSON as Laravel can sometimes return HTML. ```Http/Middleware/JsonResponseAlwaysMiddleware.php```

I wanted to keep a standard shape for API responses so created this class 'StandardApiResponse.php' for both success and error responses.

## Frontend
- The frontend is a Nuxt3 app with Vuetify3. I used the Nuxt3-Vuetify3 starter template to get started.
- 
## Tokenizer
- The tokenizer is a simple node setup that just calls the kuruomji library and runs on port 3000. 

# Testing
- With more time I would have written Factories for Words, Senses, and Readings so that unit tests could be written and 
seeders could be written.
It runs on port 3000.


# Improvements
- There are lots of places to add exceptions and error checking/handling
- Using objects instead of arrays for senses, words, readings but no generics
- API isn't documented


