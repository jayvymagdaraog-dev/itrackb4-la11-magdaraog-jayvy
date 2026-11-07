G1. Route model binding needs two things to be true. Name both, and say what happens when only one of them is.

Route model binding needs two things: the route parameter name must match the controller's model variable, and the model must exist in the database with the correct ID. If only one condition is met, Laravel may fail to resolve the model and return a 404 error.


G2. Your Delete link opened the detail page instead of deleting anything. Explain why.

My Delete link opened the detail page because a normal link sends a GET request instead of a DELETE request. To delete a record, I need to use a form with POST method and @method 'DELETE' to connect it to the destroy route.


G3. old() takes a second argument on your edit form. What would break if you left it out, and what would break if you used only it?

The second argument in old() provides the movie's original value when the edit page first loads. If I leave it out, the form fields will be empty when I open the edit page, and if I use only the original value, the values I typed will disappear after validation fails.
