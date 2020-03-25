import numpy as np
import matplotlib.pyplot as plt
import requests
import json
import sys
countries = input("Countries to compare: ").split (",")
start = int(input("Starting from what number of cases: "))
plotdead = input("Do you want to plot number of deaths as well? (y/n): ")
if plotdead == "y":
    plotdead = True
else:
    plotdead = False
plotpercent = input("Do you want to plot the percetage of the cases that died as well? (y/n): ")
if plotpercent == "y":
    plotpercent = True
else:
    plotpercent = False
countries_cases = {}
countries_deaths = {}
countries_percents = {}
for country in countries:
    cases = np.array([])
    deaths = np.array([])
    r1 = requests.get("https://corona.lmao.ninja/historical/" + country)
    if r1.status_code != 200:
        sys.exit("can\'t get historical data")
    historical_list = r1.json()
    for case, death in zip(list(historical_list["timeline"]["cases"].values()), list(historical_list["timeline"]["deaths"].values())):
        if case != None and int(case) > start:
            cases = np.append(cases, case)
            deaths = np.append(deaths, death)
    r2 = requests.get("https://corona.lmao.ninja/countries/" + country)
    if r2.status_code != 200: #if there is such a person
        sys.exit("can\'t get current data")
    current_list = r2.json() #parse json
    cases = np.append(cases, current_list["cases"])
    deaths = np.append(deaths, current_list["deaths"])
    """if country == "Turkey":
        cases = np.append(cases, 1256)
        deaths = np.append(deaths, 30)"""
    countries_cases[country] = cases
    countries_deaths[country] = deaths
    countries_percents[country] = np.divide(deaths, cases)*100
plt.figure(1)
for country in countries:
    plt.plot(range(len(countries_cases[country])), countries_cases[country], label=country+" cases")
    if plotdead:
        plt.plot(range(len(countries_deaths[country])), countries_deaths[country], label=country+" deaths")
plt.xlabel("Days")
plt.ylabel("Num. of people")
plt.title("Coronavirus cases in given countries (linear scale)")
plt.legend()
plt.figure(2)
for country in countries:
    plt.plot(range(len(countries_cases[country])), countries_cases[country], label=country+" cases")
    if plotdead:
        plt.plot(range(len(countries_deaths[country])), countries_deaths[country], label=country+" deaths")
plt.xlabel("Days")
plt.ylabel("Num. of people")
plt.title("Coronavirus cases in given countries (log scale)")
plt.yscale("log")
plt.legend()
if plotpercent:
    plt.figure(3)
    for country in countries:
        plt.plot(range(len(countries_percents[country])), countries_percents[country], label=country+" deaths/cases ratio")
    plt.xlabel("Days")
    plt.ylabel("% of people who died")
    plt.title("Percentage of deaths/cases in given countries")
plt.legend()
plt.show()
