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
countries_cases = {}
countries_deaths = {}
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
    countries_cases[country] = cases
    countries_deaths[country] = deaths

plt.figure(1)
for country in countries:
    plt.plot(range(len(countries_cases[country])), countries_cases[country], label=country+" cases")
    if plotdead:
        plt.plot(range(len(countries_deaths[country])), countries_deaths[country], label=country+" deaths")
plt.legend()
plt.figure(2)
for country in countries:
    plt.plot(range(len(countries_cases[country])), countries_cases[country], label=country+" cases")
    if plotdead:
        plt.plot(range(len(countries_deaths[country])), countries_deaths[country], label=country+" deaths")
plt.yscale("log")
plt.legend()
plt.show()
"""
turkey_cases = np.array([1, 1, 5, 6, 18, 47, 98, 191, 359, 670, 947])
turkey_deaths = np.array([0, 0, 0, 0, 1, 1, 2, 3, 4, 9, 21])
italy_cases = np.array([2, 2, 3, 3, 20, 79, 150, 229, 322, 445, 650, 888, 1128, 1694, 2036, 2502])
italy_deaths = np.array([0, 0, 0, 0, 1, 2, 3, 6, 10, 12, 17, 21, 29, 34, 52, 79, 107, 148, 197])

plt.figure(1)
plt.plot(range(len(turkey_cases)), turkey_cases, label="Türkiye vakalar")
plt.plot(range(len(turkey_cases)+5), italy_cases[:len(turkey_cases)+5], label="İtalya vakalar")
plt.plot(range(len(turkey_cases)), turkey_deaths, label="Türkiye ölümler")
plt.plot(range(len(turkey_cases)+5), italy_deaths[:len(turkey_cases)+5], label="İtalya ölümler")
plt.legend()

plt.figure(2)
plt.plot(range(len(turkey_cases)), turkey_cases, label="Türkiye vakalar")
plt.plot(range(len(turkey_cases)+5), italy_cases[:len(turkey_cases)+5], label="İtalya vakalar")
plt.plot(range(len(turkey_cases)), turkey_deaths, label="Türkiye ölümler")
plt.plot(range(len(turkey_cases)+5), italy_deaths[:len(turkey_cases)+5], label="İtalya ölümler")
plt.yscale("log")
plt.legend()
plt.show()
"""
