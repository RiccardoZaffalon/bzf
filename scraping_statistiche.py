# -*- coding: utf-8 -*-
"""
Created on Sun Jan 15 09:42:20 2017

@author: MarcoBz
"""

import requests
import io
from bs4 import BeautifulSoup

req = requests.get('http://www.gazzetta.it/calcio/fantanews/statistiche/serie-a-2016-17/')
all_players = BeautifulSoup(req.content, 'html.parser').find('tbody')
filename = 'stat.csv'
players = all_players.find_all('tr')
open(filename, 'w').close()
with io.open(filename, 'a', encoding='utf8') as datafile: 
    # Scrivo nomi colonne
    colonne = ['team', 'name', 'role', 'Q', 'PG', 'G', 'A', 'AM', 'ES', 'RT', 'RR', 'RS', 'RP', 'MV', 'MM', 'MP', 'player_id']
    datafile.write(','.join(colonne))
    datafile.write('\n')
        
    for player in players:            
        count = 1
        stats = player.find_all('td')
        num_stat = len(stats)
        for num in range(1,num_stat): 
                try :
                    datafile.write(stats[num].text.strip() + ',')
                except:
                    pass            
        name = player.find('a')['href']
        # Split unico, prima per '/'
        name_split = name.split('/')[-1].split('_')
        # Da risolvere nomi variabili es: Hernanes, Daniele De Rossi

        # # Scrivo cognome o nome unico
        # try :
        #     datafile.write(name_split[-2] + ',')
        # except:
        #     pass
        # # Scrivo nome se ce l'ha
        # try :
        #     datafile.write(name_split[-3] + ',')
        # # Se non ce l'ha scrivo un trattino
        # except:
        #     datafile.write('-' + ',')

        # Codice Giocatore
        try :
            datafile.write(name_split[-1] + '\n')
        except:
            pass

datafile.close()