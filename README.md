# Club World Cub

This project has been created by Stijn Kluiters as requested by Berlinger as an codekata to check out my coding skills untill now.


# Setup and installation

I've used Windows to create this project. Use this link to install the same way as i did: https://codewithbish.com/how-to-run-laravel-8-using-docker-in-windows-for-beginners/
But skip step 2;

After the installation you should see that the .env has been created for you. If not, then follow the default laravel installation guide.

1. Run `php artisan migrate` in the docker environment to setup the database tables.
2. Run `php artisan db:seed` to enter the berlinger teams.
3. Hitting F5 generates a new score on the page.

# Known issues:

- Running `php artisan migrate` or `php artisan db:seed` (database connections) in WSL requires the argument DB_HOST=127.0.0.1
BUT Actually running and using the application requires: DB_HOST=mysql (this probably is fixable by entering the docker container instead of manually connecting through ~WSL!)


# Not implemented (yet):
Due to shortage of time I did not implement the following features: 
- The winners of the leagues play the final match
- Not every team get's picked yet to play matches against eachother. Only the first 5 from the database records.
  - Solveable by allowing to run multiple leagues on the page.
- Not everything is unittested yet. I have made a couple ( a general idea ) to see how i would solve the rest too.

# A little different implementation:
- "The matched played are already known, see next page" |

I liked it more when every team is also selected randomly team also was selected randomly, so not only the goals are random, but also the teams are!
  (And no! In a real situation I would not change the functionality by myself ;) )

# Usage of the code: 
- The Valueobjects are used to make it more easy to unittest because in my opinion a model has too many responsibilities. Containing attributes and database connection which doesn't allow for easy Mockery.
- I have tried to make a layer of functional and technical classes. The services as functional interfaces, and the rest for technical purposes.
- I love dependency injection due to the fact that it is easily mockable
