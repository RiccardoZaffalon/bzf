# -*- coding: utf-8 -*-
"""
Created on Sun Jan 15 09:42:20 2017

@author: MarcoBz
"""

import requests
import io
from bs4 import BeautifulSoup

req= requests.get('http://www.gazzetta.it/calcio/fantanews/statistiche/serie-a-2016-17/')
all_players=BeautifulSoup(req.content, 'html.parser').find('tbody')
filename='stat.csv'
players=all_players.find_all('tr')
open(filename, 'w').close()
with io.open(filename, 'a', encoding='utf8') as datafile:
   
        
        for player in players:
            
            count=1
            stats=player.find_all('td')
            num_stat=len(stats)
            for num in range(1,num_stat): 
                     try :
                         datafile.write(stats[num].text.strip()+ ',')
                     except:
                         pass
            
            name=player.find('a')['href']
            split1=name.split('_')
            split2=split1[0].split('/')
            try :
                    datafile.write(split2[-1]+ ',')
            except:
                    pass
            try :
                    datafile.write(split1[-2]+ ',')
            except:
                    pass
            try :
                    datafile.write(split1[-1]+ '\n')
            except:
                    pass
datafile.close()
