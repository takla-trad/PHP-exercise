# Backend

Implemented in PHP 

The script receives as input the path to a CSV file to be imported, a column number in which to search, and a search key.

The script is invoked in this way (example in PHP):

```
$ php search.php file.csv 2 Alberto
```

**file.csv** represents the path to a CSV file <br> 
**2** represents the index of the column to search in (in the previous file the name) <br> 
**Alberto** represents the search key.<br> 

The output of the command must be the corresponding line.
