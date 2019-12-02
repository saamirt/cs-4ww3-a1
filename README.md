name: Syed Aamir Tahir
student number:400134432
macid: tahirs1
git username: saamirt
git emai: saamirt@gmail.com
url: https://mcmaster.ml

where I went above and beyond the scope: I used the Block Element Modifier standard in writing my CSS to set a standard for highly modular, less convoluted, and easily readable CSS, while also adding faster rendering to pages by reducing the need to repeatedly redraw the page. Furthermore, I also used Adobe Illustrator to design a clean and thematically appropriate background for the site. Finally, I also used Bootstrap in order to build a more responsive website and Font-Awesome to provide stylish vector icons.

For this part of the assignment, i used a more advanced sql query to get all reviews connected to a pokestop and average their ratings to get the pokestop's average rating. This was done with the following query:

    SELECT * FROM pokestops JOIN (SELECT pokestopID, AVG(rating) as avg_rating FROM reviews GROUP BY pokestopID) table2 ON pokestops.pokestopID = table2.pokestopID

Note: I also decided to combine the search and results page as I thought it was more intuitive that way.