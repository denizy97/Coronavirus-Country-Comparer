# Corona-Country-Comparer
Plot cases and deaths in selected countries starting from the a certain amount of cases. Useful to compare how good/bad countries react to COVID-19.

## Update
* I put a web version of this program at https://deniz-yildirim.org/corona.php check it out!

## How to use the python program
* Run corona.py
* Enter country or countries to plot, first letters should be capital, some countries are abbreviated, no space between commas. Ex: "US,China,Italy"
* Enter the amount of cases the start the plot from, this is needed to align the trends of the countries. In my experience countries start to follow similar trends after around 1000 cases so that's a good number to start with but you would need to lower the number if there aren't that many cases in the country you want to compare for example. Experiment and adjust accordingly.
* Answer the rest of the y/n questions (for the simplest option just select "n" or press enter without typing anything)
* Enjoy

## Notes
* The python program uses endpoints from the CoronaVirus REST API (https://corona.lmao.ninja)
* The PHP web version uses only the John Hopkins database from https://github.com/CSSEGISandData/COVID-19
* You can do whatever you want with this program, idc
