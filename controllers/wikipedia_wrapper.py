import wikipedia

def getFact(subject):
    print "DEBUG: This is the subject"
    print subject
    suggestion = wikipedia.suggest(subject)
    print "DEBUG: This is the suggestion"
    print suggestion
    if suggestion is None or suggestion == "":
        suggestion = subject
        print "DEBUG: No suggestion found for input, set suggestion to subject"
    page = wikipedia.page(title=suggestion, auto_suggest=True, redirect=True)
    print "DEBUG: This is the page"
    print page
    # print page.html()
    print "DEBUG: This is the page summary"
    # print page.summary
    f = open('content.txt', 'w')
    content = page.content
    content = content.encode(encoding='UTF-8')
    f.write(content)
    # print page.content
    return "DEBUG: This is a test output signifying the end of getFact()"