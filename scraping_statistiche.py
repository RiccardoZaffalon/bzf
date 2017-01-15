# -*- coding: utf-8 -*-
"""
Created on Sun Jan 15 09:42:20 2017

@author: MarcoBz
"""

import requests
import io
import string
from bs4 import BeautifulSoup

req= requests.get('http://www.gazzetta.it/calcio/fantanews/statistiche/serie-a-2016-17/')
all_players=BeautifulSoup(req.content, 'html.parser').find('tbody')
filename='stat.csv'
players=all_players.find_all('tr')
open(filename, 'w').close()
with io.open(filename, 'a', encoding='utf8') as datafile:
   
        
        for player in players:
            
            count=1
            for stat in player.find_all('td'): 
                if count != 17:
                    if count != 1: 
                     try :
                         datafile.write(stat.text.strip()+ ',')
                     except:
                         pass
                else:
                    try :
                        datafile.write(stat.text.strip()+ ',')
                    except:
                        pass 
                count += 1
            name=player.find('a')['href']
            split1=string.split(name,'_')
            split2=string.split(split1[0],'/')
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