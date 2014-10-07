Some Markdown examples
======================

###Links

```
[I'm an inline-style link](https://www.google.com)

[I'm an inline-style link with title](https://www.google.com "Google's Homepage")

[I'm a reference-style link][Arbitrary case-insensitive reference text]

[I'm a relative reference to a repository file](../blob/master/LICENSE)

[You can use numbers for reference-style link definitions][1]

Or leave it empty and use the [link text itself]

Some text to show that the reference links can follow later.
```

[I'm an inline-style link](https://www.google.com)

[I'm an inline-style link with title](https://www.google.com "Google's Homepage")

[I'm a relative reference to a repository file](../blob/master/LICENSE)

You can create an inline link by wrapping link text in brackets `( [ ] )`, and then wrapping the link in parenthesis `( ( ) )`.

For example, to create a hyperlink to [www.github.com](http://www.github.com), with a link text that says, Visit GitHub!,
  you'd write this in Markdown: `[Visit GitHub!](http://www.github.com)`.

You can also surround a url with `<` and `>` for automated links.  This way you cannot specify the text, instead the text will be the url.
`<http://example.com/>`  <http://example.com/>

###Tables
```
Colons can be used to align columns.

| Tables        | Are           | Cool  |
| ------------- |:-------------:| -----:|
| col 3 is      | right-aligned | $1600 |
| col 2 is      | centered      |   $12 |
| zebra stripes | are neat      |    $1 |
```

Colons can be used to align columns.

| Tables        | Are           | Cool  |
| ------------- |:-------------:| -----:|
| col 3 is      | right-aligned | $1600 |
| col 2 is      | centered      |   $12 |
| zebra stripes | are neat      |    $1 |

###Block Quotes
```
> Blockquotes are very handy in email to emulate reply text.
> This line is part of the same quote.

Quote break.

> This is a very long line that will still be quoted properly when it wraps. Oh boy let's keep writing to make sure this is long enough to actually wrap for everyone. Oh, you can *put* **Markdown** into a blockquote.
```

> Blockquotes are very handy to note something to the user!.
> This line is part of the same quote.

Quote break.

> This is a very long line that will still be quoted properly when it wraps. Oh boy let's keep writing to make sure this is long enough to actually wrap for everyone. Oh, you can *put* **Markdown** into a blockquote.


###Inline HTML

```
<dl>
  <dt>Definition list</dt>
  <dd>Is something people use sometimes.</dd>

  <dt>Markdown in HTML</dt>
  <dd>Does *not* work **very** well. Use HTML <em>tags</em>.</dd>
</dl>
```

<dl>
  <dt>Definition list</dt>
  <dd>Is something people use sometimes.</dd>

  <dt>Markdown in HTML</dt>
  <dd>Does *not* work **very** well. Use HTML <em>tags</em>.</dd>
</dl>

###Horizontal rules

```
Three or more...

---

Hyphens

***

Asterisks

___

Underscores
```

Three or more...

---

Hyphens

***

Asterisks

___

Underscores


###Headings

```
# The largest heading (an <h1> tag)
## The second largest heading (an <h2> tag)
…
###### The 6th largest heading (an <h6> tag)
```

# The largest heading (an <h1> tag)
## The second largest heading (an <h2> tag)
…
###### The 6th largest heading (an <h6> tag)

###Styling

```
*This text will be italic*
**This text will be bold**
```
Both bold and italic can use either a * or an _ around the text for styling. This allows you to combine both bold and italic if needed.

```
**Everyone _must_ attend the meeting at 5 o'clock today.**
```

###Lists
####Unordered:
```
* Item
* Item
* Item

- Item
- Item
- Item
```

####Ordered:
```
1. Item 1
2. Item 2
3. Item 3
```


###Images
```
![Alt text](/path/to/img.jpg)

![Alt text](/path/to/img.jpg "Optional title")
```

![Placeholder image](http://placehold.it/350x150)

![Placeholder image](http://placehold.it/350x150 "Placeholder image")

###Mastering Markdown
If you want to know more about plain markdown visit [this site](https://guides.github.com/features/mastering-markdown/).
