# -*- coding: utf-8 -*-
"""
Created on Sat Jan 14 09:40:34 2017

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
                ctrl = False
        elif int(quest1) == 0:
            quest3=input('Quale giornata?')
            if quest3 is int:     
                last_match = int(quest3)
                all = False
                ctrl = True
            elif not quest3:
                last_match = last_match_def
                first_match = first_match_def
                all = all_def
                ctrl = True
            else:
                ctrl = False            
        else:
             ctrl = False
    else:
        quest3 = input('Quale giornata?')
        if quest3 is int: 

            last_match = int(quest3)
            all = False
            ctrl = True
        elif not quest3:
            last_match = last_match_def
            first_match = first_match_def
            all = all_def
            ctrl = True
        else:
            ctrl = False
if not all:
    first_match = last_match
all_matches = range(first_match, last_match+1)
for match in all_matches:
    req = requests.get('http://www.gazzetta.it/calcio/fantanews/voti/serie-a-2016-17/giornata-'+str(match))
    elenco = BeautifulSoup(req.content, 'html.parser').find('div', {"class":"magicDayList listView magicDayListChkDay"})
    filename = 'data_'+str(match)+'.csv'
    teams = elenco.find_all('ul', {"class":"magicTeamList"})
    open(filename, 'w').close()
    name = []
    with io.open(filename, 'a', encoding='utf8') as datafile:
        for team in teams:
            for player in team.find_all('li', {"class": ""}): 
                try :
                    datafile.write(player.find('span',{"class":"playerNameIn"}).get_text() + ',')
                except:
                    pass
                try :
                    datafile.write(team.find('span',{"class":"teamNameIn"}).get_text() + ',')
                except:
                    pass
                try :
                    datafile.write(player.find('span',{"class":"playerNumber"}).get_text() + ',')
                except:
                    pass
                name = player.find('a')['href']
                split1 = name.split('_')
                split2 = split1[0].split('/')
                try :
                    datafile.write(split2[-1] + ',')
                except:
                    pass
                try :
                    datafile.write(split1[-2] + ',')
                except:
                    pass
                try :
                    datafile.write(split1[-1] + ',')
                except:
                    pass
                try :
                    datafile.write(player.find('span',{"class":"playerRole"}).get_text() + ',')
                except:
                    pass
                count = 1
                stats = player.find_all('div',{"class":"inParameter"})
                num_stat = len(stats)
                for num in range(0, num_stat-1): 
                   try :
                       datafile.write(stats[num].text.strip() + ',')
                   except:
                        pass                    
                try :
                    datafile.write( stats[-1].text + '\n')
                except:
                    pass 
datafile.close()