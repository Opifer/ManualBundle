#Search Help Articles README


##Intro
This read me shows you how the help article search feature works.
A step by step guide on how to add a help article is included.
This bundle is used in conjunction with the `OpiferCmsBundle`.


##How it works!
On the homepage (`/admin/help` by default) you will see a list of
available articles. Those are links and will link to the corresponding
article for the user to view. There is also a search box so the user
can filter on a specific article.

The search box is made with [AngularJS](http://angularjs.org).
It looks for text you put in the search box.


##Getting familiar with **Markdown**
The help articles are written in [Markdown](http://http://daringfireball.net/projects/markdown/)
This makes it real easy to write good looking text. No need for complex HTML
documents. If you need more information on how to write markdown, you can either, click
on the link above, or in the Help section of the CMS there is an article called.
`Markdown Examples`. In that article you can find all markdown elements
available in for the standard markdown.
> NOTE: GFM (Github Flavored Markdown) and other variants are not supported.
> This CMS only supports standard markdown.

##How to add manual items
This bundle relies on a folder structure to load all the available markdown.
the default folder structure is as follows.
```
Vendor
    - MyBundle
        - Resources
            - manual
                + File1
                + File2
                etc.
```
Where *Vendor* is your vendor prefix and *MyBundle* is your bundle.
The `-` are folders and the `+` are files.

When you have that structure in place, add the bundles you want to load in:  
`app/config/config.yml`  
Once you've done that, it should look something like this:  
![Manual Configuration example](http://i.imgur.com/1LBTwq0.png)

Internally this bundle will resolve the bundle name and append the `/Resources/manual` folders. In there it will
search for all folders inside, the name will result in the category name.
In those folders you need to place all the markdown files belonging to that category.
The name of the markdown file will result in the name of that article.
This means you can do something like: `My First Markdown file.md`.

> NOTE: This follows the rules of file naming. The title can not consist of characters which can't be put in a file name.

##Markdown Tips 'n Tricks
Some tips and tricks on how to style your markdown file correctly.
- Since the `===` and the `#` (1 hash-tag) result in `<h1></h1>` tags
it is advised to only use either one of those per document as an `<h1></h1>` tag is used for a title.
- As the title is the same as your file name and is printed on the article detail page it is advised to use a different 
title in your markdown file.

##Other Tips
###Best Practices
The guys at SensioLabs have created a Symfony best practices documentation
Please take a look at it [Here](http://symfony.com/doc/current/best_practices/index.html).
As the documentation states, you don't need to adopt these in existing applications, but it is
advised to used these best practices in new apps as it optimizes your Symfony application.

Also, if you want to create/edit markdown files from within a IDE or Sublime/Textmate for example, make sure you have `Strip whitespaces on end of line` turned **OFF** for .md files.
This is because in Markdown having 2 whitespaces on the end of a line followed by an line break is the equivalent of a new line.
If you don't have 2 spaces on the end of a line, the line underneath it will be wrapped to fill the content area. 
So to force a line break, you **NEED** to have 2 spaces on the end of a line followed by a line break.
