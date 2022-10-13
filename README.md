# andreamiele.github.io

My [Hugo](https://gohugo.io)-powered personal website.

Current theme: [XXX](xxx).

Published to [www.andreamiele.github.io](https://www.andreamiele.github.io) on [GitHub Pages](https://pages.github.com/) via [Hugo Setup Action](https://github.com/peaceiris/actions-hugo).

## Development notes

### Testing the site locally

```bash
hugo server -D
```

### Generating a PDF version of slides

Use [pandoc](https://pandoc.org/) in the Markdown source file directory (`content/slides/<title>`):

```bash
pandoc index.md -o <PDF file name>.pdf --toc
```
