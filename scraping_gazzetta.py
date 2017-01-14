# -*- coding: utf-8 -*-
"""
Created on Sat Jan 14 09:40:34 2017

@author: MarcoBz
"""
import requests
import io
from bs4 import BeautifulSoup
last_match=19
first_match=1
all=False
if not all:
    first_match=last_match
all_matches=range(first_match, last_match+1)
for match in all_matches:
    req= requests.get('http://www.gazzetta.it/calcio/fantanews/voti/serie-a-2016-17/giornata-'+str(match))
    elenco=BeautifulSoup(req.content, 'html.parser').find('div', {"class":"magicDayList listView magicDayListChkDay"})
    filename='data_'+str(match)+'.csv'
    teams=elenco.find_all('ul', {"class":"magicTeamList"})
    open(filename, 'w').close()
    name=[]
    with io.open(filename, 'a', encoding='utf8') as datafile:
        for team in teams:
            for player in team.find_all('li', {"class": ""}): 
                try :
                    datafile.write(player.find('span',{"class":"playerNameIn"}).get_text()+ ',')
                except:
                    pass
                try :
                    datafile.write(team.find('span',{"class":"teamNameIn"}).get_text()+ ',')
                except:
                    pass
                try :
                    datafile.write(player.find('span',{"class":"playerNumber"}).get_text()+ ',')
                except:
                    pass
                try :
                    datafile.write(player.find('span',{"class":"playerRole"}).get_text()+ ',')
                except:
                    pass
                count = 1
                for stat in player.find_all('div',{"class":"inParameter"}):
                    if count != 2 and count != 9:
                       try :
                           datafile.write( stat.get_text()+ ',')
                       except:
                            pass   
                    if count == 9:
                        try :
                            datafile.write( stat.get_text()+ ',\n')
                        except:
                            pass 
                    count += 1
datafile.close()
    
