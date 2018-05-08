This is a vanilla Virtue Theme child theme that is built to work in the CARES environment.

The biggest "feature" here is that this theme will de-enqueue the Virtue "plugins" js file, which includes Bootstrap, if it looks like Bootstrap has been enqueued separately, like by the CARES Data Tools plugin, to avoid the dreaded double bootstrapping.

Additionally, the code to insert the Google Tag Manager containers has been included, so just update a couple of places in functions.php, and uncomment those hooks, and you should be in business.

CSS: Use css/style.scss if you want to use scss, then compile using Grunt, or delete the Grunt stuff and work in style.css directly.
