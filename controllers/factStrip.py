import re
import string

def factStrip(article):
    factArray = [];
    marker = 0
    eosPattern = re.compile("\.[\" \n]+[A-Z=]")
    sopPattern = re.compile("\n+[A-Z]")
    i = 0
    while True:
        testString = ""
        oldMark = marker
        while True:
            newMarkObj = eosPattern.search(article, oldMark)
            if newMarkObj is None:
                break
            newMark = newMarkObj.end() - 1
            appStr = article[oldMark:newMark]
            appStr = string.rstrip(appStr)
            if newMark - marker <= 320 and appStr[0] !='\n':
                testString += appStr
                oldMark = newMarkObj.start() + 1
            else:
                break
        testString = testString.replace('\n', '')
        if testString and testString[0] != '=':
            factArray.append(testString)
        markerObj = sopPattern.search(article, oldMark+2)
        if markerObj is None:
            break
        marker = markerObj.end() - 1
        i = i + 1

    return factArray



