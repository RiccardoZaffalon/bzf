# -*- coding: utf-8 -*-
"""
Created on Wed Jan 18 22:29:08 2017

@author: MarcoBz
"""

import requests
import io
from bs4 import BeautifulSoup
last_match_def = 19
first_match_def = 1
all_def = False
ctrl = False
while ctrl == False:
    quest1 = input('Vuoi tutte le giornate (1 for yes, 0 for no)?')
    if quest1:
        try:
            if int(quest1) == 1:
                all = True
                quest2 = input('Fino a quale giornata?')
                if quest2:
                    try:
                        last_match = int(quest2)
                        first_match = 1
                        ctrl = True
                    except:
                        ctrl = False                    
                else:
                   last_match = last_match_def
                   first_match = first_match_def
                   all = all_def
                   ctrl = True
            elif int(quest1) == 0:
                quest3 = input('Quale giornata?')
                if quest3:
                    try:
                        last_match = int(quest3)
                        all = False
                        ctrl = True
                    except:
                        ctrl = False    
                else:
                    last_match = last_match_def
                    first_match = first_match_def
                    all = all_def
                    ctrl = True              
        except:
            ctrl = False
    else:
            quest3 = input('Quale giornata?')
            if quest3:
                try:
                    last_match = int(quest3)
                    all = False
                    ctrl = True
                except:
                    ctrl = False    
            else:
                last_match = last_match_def
                first_match = first_match_def
                all = all_def
                ctrl = True           
if not all:
    first_match = last_match
all_matches = range(first_match, last_match+1)
for match in all_matches:
    req = requests.get('http://www.datasport.it/temporeale/serie-a-risultati-classifica-notizie-diretta.htm?idediz=undefined&urlLevel='+str(match))
    squadra1 = BeautifulSoup(req.content, 'html.parser').find_all('div', {"class":"nTeam"})
    squadra2 = BeautifulSoup(req.content, 'html.parser').find_all('div', {"class":"nTeamB"})
    res1 = BeautifulSoup(req.content, 'html.parser').find_all('div', {"class":"nResult"})
    res2 = BeautifulSoup(req.content, 'html.parser').find_all('div', {"class":"nResult2"})
    filename = 'matches_'+str(match)+'.csv'
    open(filename, 'w').close()
    num_matches = len(squadra1)
    ran_matches = range(0,num_matches)
    with io.open(filename, 'a', encoding='utf8') as datafile:
        colonne = ['Home', 'Away', 'Ris Home', 'Ris Away']
        datafile.write(','.join(colonne))
        datafile.write('\n')
        for m in ran_matches:
            try :
                    datafile.write(squadra1[m].get_text() + ',')
            except:
                    pass
            try :
                    datafile.write(squadra2[m].get_text() + ',')
            except:
                    pass
            try :
                    datafile.write(res1[m].get_text() + ',')
            except:
                    pass
            try :
                    datafile.write(res1[m].get_text() + '\n')
            except:
                    pass
    datafile.close()
    filename = 'rank_'+str(match)+'.csv'
    open(filename, 'w').close()
    Pos = BeautifulSoup(req.content, 'html.parser').find_all('div', {"class":"resPos1"})
    Team = BeautifulSoup(req.content, 'html.parser').find_all('div', {"class":"resTeam"})
    Cont = BeautifulSoup(req.content, 'html.parser').find_all('div', {"class":"resPosCont"})
    with io.open(filename, 'a', encoding='utf8') as datafile:
        colonne = ['Pos', 'Team', 'Pt Tot', 'Pt Hm', 'Pt Aw', 'Tot Matches', 'Tot W', 'Tot D', 'Tot L', 'Tot GF', 'Tot GA', 'Hm Matches', 'Hm W', 'Hm D', 'Hm L', 'Hm GF', 'Hm GA', 'Aw Matches', 'Aw W', 'Aw D', 'Aw L', 'Aw GF', 'Aw GA']
        datafile.write(','.join(colonne))
        datafile.write('\n')
        for num in range(1,len(Pos)):
            try :
                datafile.write(Pos[num].get_text() + ',')
            except:
                pass
            try :
                datafile.write(Team[num].get_text() + ',')
            except:
                pass
            all_cont = Cont[num].find_all('div', {"class":"resPos"})
            for num_cont in range(0,len(all_cont)-1):
                try :
                    datafile.write(all_cont[num_cont].get_text() + ',')
                except:
                    pass
            try :
                datafile.write(all_cont[-1].get_text() + '\n')
            except:
                pass
        datafile.close()
            
            
                
                
                
                
                