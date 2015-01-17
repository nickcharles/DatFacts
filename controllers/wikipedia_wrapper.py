import wikipedia

def getFact(subject):
    suggestion = wikipedia.suggest(subject)
    print suggestion
    if suggestion is None or suggestion == "":
        print "DEBUG: No suggestion found for input"
    page = wikipedia.page(title=suggestion, auto_suggest=True, redirect=True)
    print page
    # print page.html()
    print page.content
    return "DEBUG: This is a test output signifying the end of getFact()"