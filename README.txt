PMC stands for PoorMansCron

the PHP includes a series of functions to handle your custom cache

You can add an update function (the one wich stores the data) a cache function (the one who retrieves the data back from the update process)
a path to a custom json file where the last update time was saved, and the time in seconds wich the function will check if it is time to update again