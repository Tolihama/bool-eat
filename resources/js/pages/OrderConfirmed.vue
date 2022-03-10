<template>
    <div class="container pt-4" id="order-confirmed">
     <div class="cart my-4 p-3">
        <h1 class="mb-4">L'ordine è stato effettuato con successo!</h1>
        <div class="p-2 d-flex">
            <section class="mr-3 col">
                <h3 class="text-center mb-3">Dettagli Ordine</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Numero Ordine</th>
                            <th scope="col">Data Ordine</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <h4>TOTALE</h4>
                            </td>
                            <td>totale</td>
                        </tr>
                         <tr>
                            <td>Pagato con:</td>
                            <td>Metodo di pagamento</td>
                        </tr>
                    </tbody>
                </table>
            </section>
            <section class="p-2 col">
                <img class="ml-4" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAP0AAADHCAMAAADlCqUFAAAA/FBMVEX///8AAAAKCw37+/v39/fi4uLo6Ojs7Ozw8PD09PSioqLNzc3X19fp6enXAADg4ODV1dUwMDDGxsZwcHA8PDygoKCDg4PjAAC5ubmwsLCOjo5UVFSLi4tnZ2eUlJTHx8dLS0teXl5DQ0Nvb2+qqqoVFRUuLi59fX0cHBzUAAA2NjYnJydJSUkgICBhYWEYGBj43uDkABDdV13qt7r67vDVEx7kiI3ZTFLwxsn119jPAAjjf4PjChbWQkn65ujfcHbILjfnmZ3LHyjqpannycvSb3TOWF7ZMjrSABLhdHncVVvmQkrfIyvXNTzrsLPkZmzmhYnwmp/mwMLBAADMsf3jAAAZhUlEQVR4nO1dB3fa2LaWEF1CgCiSEMg0U41L7NjYie1xyL1OMo49M+///5d3uo4KIIEwvrP41ooDQuXsvs8+RYJwwAEHHHDAAQcccMABBxxwwAHRkUxpZqNiVY9FirNqp9IwtWJu303bLZJyrTUQl2NkNY3ivhu5E2SNISF8ag1rfUNWiql0Op0qlmSjXxt2JowHli1L+25trCjaE0KYkVpKWUbODykPrH7hPdu3QyjNGSSoZ6ZCnCwp/R5mQNVO77xpu0a2NgWUTGwlykXp/ilmgJncVbveA6UWoOHYDiN0DyR5iBhQ+Z/1gkYZNr+08fVyBdLf1WJs0ruhfwaaXtsuhktGF9xkYMTUpHdDH4a2la3OpaH3l4y+tpJDxeHaO300GGfLJYYiXhHqNPSEdfgBHuk3bDn4gpwNHeDmBvTOkKuimAim3TgRxSb4P93u1e0s+JC0m00b/gK50FxyQwnS38ruprXxIgv9vO0/jiR7Kg7qS0RckGswNpggPPpNQWpCJxJnM3cDEzTz1CcmGL+Q7q4N4CUL3CDgrAxgavmDh78caPuxX7jAzAfhUzfNhH/r3iyhNF1uGx8CGpBb3X0oiRxAPrLUAMMsb6QH5j/5uOkvcOAJt+CToMEbZHoQGsh2M55jKdALMje73a6RBZlJy92DAwJM1DbO1bOIUPflDZA9bnq/XaIkBsjFCpCUlBPq4VPAosfVy8D5fbzYB5K7M5eOBwQ9jJ44FcOXL6ArceUOSZAyLAmaewOIaBZPEnDQweSDzCUBUrcIXjAvjtzMGn4047c8waiyLDepAU8AEMl4Ja+d9APTqX0hV/ZKo2553TXBBBEPyI/ab+kfcV+ORHEY8fqdIXMc2hKbhPiEmI/2DMmdSCggvES7wa6QBn6JM+NSZ8W5lPhV1EtyUG8v2xZH3FNSorjqOe8GQHyCU3Mb91yDoTnUN5acYqGCVj/gl9oZH/rTH4L8rChOOa9kieUVtegOoz4RyCNYE0E/lpe4DQ6AfCt6c2NGWZzyIumvMkfJIT4RoCLFDPMK9WVOkSsEAeXvbdbm2FARy+EzlyxHfcLbj00B52HBXACWgZdlcwVx5pCv7NvzZ9ySXwODp94b9ESYxiTEad1Mr+CnzTsZbd8VDzlKzp1wU2/1mBNPVoQjmAyIFbMinq66hyEOnC95MXLesDfILuKh7ndxDK9XFPEUsGKEFH+p2pO78D384aoI87GQ91AP6Ydhf2IpQs0yGijYta1I5HQDy2AfEU0f9YD+rFCDOf9wmmgAZjTDDd3KLB3KAX7tprVxI5D6aQ90jzKG2J1VQ3ddQNrL1F/eZY8nYzRaVTSvot2rHS21SMW0a0fLfqToiwk//bCLcAST5YQ4Cd0q4OxZU+xddffTdtkzt2Q6NP1ZmGSTOThret0ZoKWITDf5djYJO22JKDLMi1X2uSsmdjDXQ2sHz67xjkdozk9rko8TMVswNFGreSIfyHSGnYEYpe5rOw6isIOc74hNpKm2hvWKNXVxYOgwoM8fD+qdCNypQ1j/M3se6cuSWBNPyps2FbQg3lHubAdTM7IVqlVSRu5XHB4cE/dMJH86RIPt4uq7Qn1N4n4cMnlCfRVWfJb2+tYjZt03MEmW353ktDqbcwZ/LuKPkPcF+GG167OmFUPIpGrdGhzsa51Q8iegp9iJmrXlptTzpX1jKNughkla5kpTNeoMJwb2d9hfwdHo1Xn3EbluVMslK+IUZu2Y/Ew+esauOZ6vsfGYiR9E8qvuV6zz1n6GDx6Ja2Ov1Bh0kdsHHqIudlpE+QHps2nkdlacAlFCbEe+PBhJTNI6MzTPGPVEZ6E5hyk1y6eI/jxIVPq42yfOhPoGujtlUd+IzfERvV8/3EK9fQJ/Ha5TGAfFDiC/Lmj1oUTItyOUCRgyFXZRW4yuO4HAlbUwNdc0C4CGbKKMMFypLXUELDWBengl0G6c8m3ntZW4RjhQsAuVdbqMP6TCCDBsWiIOnYrQbJ+RjG/LVrfE0ZZ3wIDDkaEqRjkv7dUQpQ6YFoBOXd7qAOufdsUu8XvGZkOTWTqElI5L+MlUuCFWLPqeZhHzX53oYcA078zUQGdhCutYnRL0Hlj168YGyt9hnqYibpwsboIsJho0OWfYzVq4KWVNoiaVNEz2geob/WyHkL9JmUphriYdd767GngibRiBc9AmvQoUNjAT+BcK7gTpDviSCOlsMWTMqgpLynpiO1pbtgEW/XHUqwC96TOU5cN/XRl4/36qmKqIxyD2ASvorB/HgJA6JMBkB1TpijEmfGuBRb+Rp0lW2bCFWBETyMt0xGOrjpTCDmH+Esq1PcmxFWe2vxo41s82vNoZ0hLFchNJ76RKmCIm1laJYDETwFP6ltd0MWNET9zMTREMRY5+cVgUCrWaIBJ78M3V8qKFXad39t7kvar7KfT4wfoTl8GwaJ6M6K3OWiJkaB0H/9XX0sBBat9DOnZovtewLub+ViFGGU4Sg+6E0g9c/siuZk6hAqyekmkS4ukQbpV1dkIlm9sDFzW6cdwqXaY2MDV6MILBIdxVF5Roakmr2gaLk8Pqu3h91BeIqZKssSoXjAAi7u4vB8uvHfN4P2+HoMQnejQsC1LeCiI730Web1XMq4o+l1cLEyTjAxZ9HMslFNlEZGdIEFubP1Y8Rv/+UOJ6foE4fZg0JW1NUYoIK67IE+JjqmVsAouPN1shqiAVqh7h8uFdADvdWEKrYdcA7LB9e+bx9rhGCY9w7WOVCB1b2+M0XSz6fUyVtAnx79aZCQAWwPt1JhlkQnz7/R/tacMeZsqRcQbxeJ97E3T3JXraLWKPLhjNyjBkr65Yq7TCnrsCgaJXmm0LpyiFusWGIzPgKGmqeTopnwy9LFPs1hB776zdcRax5PKdbh2Hgb7VbpCOC4309DSz64uWUn1QRSl/yrboHfC5ZOBxsm0nCD/TtS6sdIKODbJ0HAg/F/koNC5gJoIClTlgLszmbpokowQa9a94SC1FbkGWNRjOli0s5U2PMHdKljsn0JxzT7Yj/ohvAoJEc0/xONVmDaeKegwa6gz6czVnZUYP5mkgQ7wx2cka+Yg9PJlMgXO8nCVyIH6AZEKnHXqclH6G/LnbpWhVTkoIxWPRByh7opdDucr/wjSPn/FBuQOPn/rvhlS9Qb4g4ym5T8CFsKL/SjSTzz3/JuKiCDfwTA1O9Ib/mWhQilVu3D9RtvnHwFDfJjP1H0ZVY8U5x3nmrMxRlHRfhZ4LWJUldxyUcUs2nyAi+EVvin5A9W64D7H+G7ksQMJi27FtF5A9kPkiFvfMdpoqNRoCbLnuVUQSL7Jx1iPKs20W8npFn2fPy3fYx7RXNVtpOq2LPJsxo11y7CbndGHE/hH7iEijSR5UZSJ5VE3G2p4XXBPHxIQGJ8fBltA7Qg5K6BOWvbFRSa5MyfMQ3846n6GZ8go8A48mNGKXJTFPMHS666LhSH6WdsbGUQWF/gLbTBmLyj85dpjzPqcS1T3aJjwmi/lK2r3BxH7MdiZ65rmgSKkN9AS3S4Nnk/kQJE9hxOe5U1tEXACTpOB8yXBXwBZn6Q/IIPC3glPlpWwRXdAc6mExDmlE9CFjbH1OMZEAOWWqnBLVMYdC2mI8RM98MEqKyuwyOhEGTeIo8ucQxh67WIccPUq9phyzyBU10QXEkBJtHn5S5AKBW/TMSjFnq84X23ku+o04JDwhokd/knkOGsIJ+VRF0ZvoLOpIUm8OpY1lPKU/Ia/XoJU2dlde9JC9qE6IwkyHsj+65mNrJlNEs+7nETIgazjRo9yCds2KHFn0MhIQLWb/ZBIaSYUQJ8hPTXYrE7HXpm1Ic2EXJ5Oc060jd9iVSKs0oVB27hwFbtFTFcRUUIrhTR0bTHNMw96WKQxuJg2MWdr+CW6Vzd2bGAHymMi3dQnVVrqDLpGd5IFk0lwAIAwelZCDGeUafKujYMRRxEgkoePU+caUgpxKbBAPelHjxukZ5UWNVqzIxC1yHKe4xE8UGVNSPrumoHHMSfsMZ4YkBI0M0WtDWDykc+fKvdxmyiSBS1+UMGQE1CPgXqBEeDGjRj/Ci0yS2B7wLCRiNza7VYXjthtOIZw6ly7/UAcb9HSxAqf5L7TERDUNNt7jD2gfA+k9dc1kfhbNhmUaLUkU6nL8IhaGPCbWtwx/Wx6ueleTa4NHU9obbFyCW0hET6I06VpTt2bwzSLKRdIWPM5P/BcpCVJH16EuuuhiCs7KiN6iTIFvATeDnhLlai7ybXQeb5Hr6QTMvA6BY6cVLKJIfAMxL6h4aUQhJHK5CR2IYNLL1jnmCRKxAjL3F39DyoL5z7qomPpymeaVrsJFibujQCPizKpvOC/O4KVGzBw3hHV0shy1lOuEYLLsjpOjE/ebJJ5jobIOMxaRwt0NMYJNFqnTs9r8+RS4GXStGm7vFmVwzGGimzNHIE5vDvUzC+QLXTdC+IQ+p7jzJGfUjnolycXKDk8FYnOG4yOVhuGJDwzoGK15Ycvcom+LW0WKJVitkCNKsiILHtAlEmVs7jpykTDP2k57yKnYw2sOsRDYt2F32uKaQIIa/gFmsB30yTOsV2I/C5Q/2+zSM3JkQMVdclORchqFKURwWk97dtDhcrWNKQnO8Jy0swIMd4WJa0AapyTY5ZQT0LcQP+MZ2cpznJI9TYoO/DSqSRaVNUcFYi1Ngdh6qSJrsULsGbTY4Os9Mrl3zl0mgmZA+/7ICGhfEN0WPxdpYi1QsJzBYEZUhS0wdTEYtcoUZJKMJ8iTMrSj4ky3linTGJ9SJW6cHlGGzL7FtB7dFIqexQTw2CSt3MClACWsItjUypR3LliU6wX8abrNAAiWSpt+Rd/opr8dpNIJPqdwLkTBsM9J+9hVjEUNxNQT2R7jfFxhrEX+xakXlAW5Qz4hgrDi+0qVmMOZFOFgeauFylj0LKbwzTdwNla1XYcokMNpuqq6GERNnFo+RoVoao1LT7oV7gTHaJqOXM58DXbXcbebZmFQGRA48mvDGO+qJ3rWNXDt5gqg1RShCMqEOw75xndK+Jqp5ymoekcUzp+2u/LgLdc9YNE7hUB3UYfrT6KHutwvs/cGxyWTBmnULWEdgw62XibeoeRQcaZxFVQCizQlYBkJ18WdbDnPABPLT8vEJt+kvoaQVc9CA3WP8Ek4H+1At08ynGGOauaUv3+VGhaJom3Y6uQxJ74OJYgcRD6/6hlVI2DqGXECvR8TTs4ER7atcW7UtLpWDYW5vE8L8x2rSXNzrdkwoLIT7ab0SsawxkmoWKme1MklyXp1ctonTgsqUrcpp4h24Ef1gwcmm6DV09b2g7ZEi5b+LkmRw8mEaW5EQDaUCPHvM4MANzVw9mTKHJ4gNaz2zOVjw5Ji2j3rpFrttjvDmsbKcJvsD5qp0Y7t+2w1Q8zQHzHlunuM7jTQvRTtgHiHEL3XkTNpPiVaHtZJ5m62XsEOylsAzjTO/PT4x8iUJRsYIOHJ0UrqhhPz/BUKhbYwl49zVokcpKWlDkfFxGqdEnX0zuPyjGX6Ua3ktVU7K1GkTe6Jvm2GBZg0kPUcRqxTWHHocN2xxAQ6G9KXgKSwfrsTC5qkTepmKZuUpGRRs/nEjfGvZxvKsmQ0Wcr3Rs65XTOQWUNaoK9sN0LvBklLOE0r0lBqmfzeOJJfR3DiXzVc/tCXszho92xTU9KZXE5K5rKFomzkh5ZrbsSktsxTWlQ+sU7jxJVjp3aQJNnXzPdSBJyuc11NXH/2SILmsUraaFiemQ1r0M6HCBLFOKfqk2IUS5hIrJoEDH8TLXH0su+60nUS1aWCVmvNxBCoNle/YIHBjtPsKy6Ssljpy8FD/8c8XQLOfz3rF2gpyL3iTDEbHe++PgyJ7rAfQZerMZo9KRuRiiER/LLSKLZoJ7f078RAu2xB3JMyJaPfrJxa3TJAtd3p1YEXKIYrQBdpsE/HOY2SL0FLONxWlsengVv2sCvU5n5mM9vWrzWMih4djc9vs0bOA1JoR5ZE6nKrWg73UOcm7ZtuRTECZyzGAokZ+2S7OVku2I6i4o+dNYlJik92ySwh9GoQxaYhe7qDt38Z1N5Sce41iNs7Qzv5QkR0KMRPJEZcZNvJLqA9GuUaG68L9oPUEvO0jxuZrb6h48GOdn6nLTuOsedHlFWqL9H63NqBMfdEzu6ulwhrMS5Wontt4XpUQGmwvH7Rq9SnfYJOrH2vYFgxLkJ2jToE+Xot3PqYbCoVphu3MdietqkYN1nkJ5su2Rr7ZFtFk662Z0uaRdVhjD6v4xDv7rYnbWoFpS1j9+3d+Mf5VncQoLoTn5eLcaFawSHe40elTWZ5uu9A/v+if9Xvt7sVkACVjU33+4oBzvCsz5bs7aL2w+Mf+MO5+ulGH7uFLz39MY90t36VWGVyy5UHPNiSz4DNo5J8ESO64X7Tr/GHN30xH7+5f7zU1avId0SwY+zZ0xJMYNG87niC/popnw/wz/ktpej8XLj6rKNvD/PPgA3n6PJbcNrtzT2Q+pP+BR6g5199fwjZ4DhFT+fJBo8DZZ2uylIruP75fXEvLO4eBel6PP4GiHx4e7oeX5+PLy4+P4ET/qNfXKj/FYT5z6fn8aVwO9b1z8lr9UL9Itze30H1eLy//ab/QLw5Pw/2jk7MqQeM5G4KUoNZ5tKbzshhd0kC/FP/NNZ/jfVH4VFXz8dPwtVY/arrl5C+T1C0Dze6/nYlvI5vVP03PP/Xn+rT+EJ//s/3u18vY0mYq/rXl6/q5aX642qsfwp6iMacUjrOreRRQfJkaSonOVpRWLITH6D54uL3tf4qfNZvBPVZeFIXt4APwqNK3NqD+gJUezwG9v+XINyrl3f6/AmcK7x8E67BSZ8u9N/ADZw/6dcPqhrkC5NOZmvFtQ0GRHGp1mP0nckiRnAmdKfO79SHp/H5g6o/nY/n0rMqLPSxIDyrxJTP1UdgIEA5PusLYaGqVz9+LP4GXy/Va+FG/+f88xf9+vxuAdg2n6s/gtxLj8n7KN4F8aXmam82WLMC/Vz9KY1vgKCFV/3i+W7x8Fv/BeL7ffI35ADCrQrM/zdQjrF++RewByEp3HwFjPit335XVen69ScQOLCRX6q0oGHChaJTwRy97ws0Smt2GvpHnd8CGf55Awz64mUu3OtAvd/06zk08u/olGt1ATXhuzBW58BKgEpcjv9Srxa6Pl+o+uIP6U2FIxxz9U76ogY6vTSNxs2d7CO+AkOueG37be5afVhAsT5dqRf6G6DrTyDVe/3T88vLp8U/6JQ3KFpg61fjr1/UF12dP4x/varnNy+AT590YAI33+BpC/2H9PJj5bQj5X33FYTg0v+mfyLkvQr0/PVh/Axd+q9r9eZVf54Djz5++BP8Q6e8qRLU/C8L/UJdXP3QH5/V21ddfZurfwvP+vhKUlEWPFe/vgXlw1wWNn3/1yUecTGm5esLjIGPG88BhX+BmKbr41tA3ue/1TG0AZLe3QOXD73d/W/oAG5VffwKdAQoxI/Hn+MnYAfQK8LzdB2nQC4MndL1cB/7EdS5OZkDb8o3BxEK2GoSBqrz19dbwJDLB5TTPVziUx/Gn9GJr1fYD3y/hFnALbCKxedHqB0Pc3zi6+KTfuclr+54PG0/O7AMnFBfiN7RX8AcJwRe/w+kv8+eg5rz6Oye3hSY3mri83VgFPPj5Q52hzwHNed9UVWxvXkjtoHhSokK0UTwe3wb6ryXW+luRb+vIib29b6cJmdyyWgaOH9+DXfi3e1C9Ts9ivw+35XU4TxfKlJlaRHWTV9+u3t0HTC4joWx3/dkDegaOgGRHzryJMPXMCR3npcXB+yJyp7fjZrjJ/6n4h+d9aFOF6sKqC+257dCp99546fmgBH/Ed6MqbjbkO7s+CXVjPhCbFtbboOSa0JbY4cvqZb5ckvqQxDvJV+Ls7zIQ6rwk0EVkXMAe4WClvdTZKc7EX6BrATBONp606j4AJzvdMfmDjIrLriZH+FduAyZkSfnykV7v2MYcBpV3/+bcF1Idt1ZlwxCcWzakHIX7SRryw2jdoCeeyVwahLbeHLTPZAKV2nvcVfRJQAdji4vbi2eDFwC2SRfvchvMoPoHQDnoXqri/381lu6m7yg4cZ6y0dZ9opk2zeXcwLsYeMZerLPdcK5RB/N5B3UyBJJBskcbDrQcFT1TpxAL2zcWSYZA4plUWy5nf0RrPkp0QvulthyVyvh/MHex8jvlsIOnN4GzLUVlgGpfhNWqz1rEeRBgFv5eIBbi468/l6xy3j0Y33xF86U84WLNFwkUv/ggseAu736lzAU4Cgr6BG1g/1AUjHxu08mFcPr1DNwPUx7H9uWbwSo/tUgNc02E3hlo93qtfAWoa0eWmIGd604C9QMtB/P6OMrvQO0JfAsePUYQqN70oVlKbQGAEZ0JW8EzmVF+yccb72U+p2Bd1Bqrp2dW9RWLbVC+0yEevHeR0MOzVBvmxuPNuTycN+D8j5r1lvBREtUW8YGDJAMNFf29CNnN2uh4OWLHTNSvpvES45ntV3XTHYPDa/mGtWNUCO9UqmGJsfPmh+xK7cBJI0sYJ328vKqHlpaa+DlDBP7X0I6QdHZa9oa1gw5lXGcQS5TlE27R/YpGAw33AXvgyNl1F0rPo5Hs9lsxC2zPju1Qy64/V9FAYrZci+8Pet2hnmj+O8m3INcIZ1KFbL7mn1wwAEHHHDAAQcccMABBxxwwAH/Mvw/0q+nRKzdzdUAAAAASUVORK5CYII=" alt="">
                <div class="ml-4">
                    <h2>Nome Ristorante</h2>
                    <ul>
                        <li class="text-info">
                            <i class="fa-solid fa-phone"></i>
                            Phone number
                        </li>
                        <li>
                            <i class="fa-solid fa-location-dot"></i>
                            Assress
                        </li>
                    </ul>
                </div>
            </section>
        </div>
        <hr>
        <div class="user p-2 d-flex">
            <section>
                <div>
                    <ul>
                        <li class="mb-2">
                            <i class="text-success fa-solid fa-circle-check"></i>
                            Ordine inviato 
                        </li>
                        <li>
                            <i class="fa-solid fa-motorcycle"></i>
                            Domicilio
                            <ul>
                                <li>Dati Domicilio</li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </section>
        </div>
        <div class="d-flex justify-content-end">
             <a href="#" class="btn btn-success m-3">Home</a>
        </div>
     </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'OrderConfirmed',

    methods: {
            getOrderConfirmed: function() {
                let app = this
                axios.get('http://127.0.0.1:8000/api/orderconfirmed')
                    .then(function(response) {
                        app.orderconfirmed = response.data
                    })
                    .catch(function(error) {
                        console.log(error)
                    })
            }
    }    
}
</script>

<style lang="scss" scoped>
.cart {
    width: 70%;
    margin: auto;
    border-radius: 15px;
    box-shadow: inset 0px 1px 8px 3px #ABABAB,5px 5px 5px -100px #DDDDDD;
    -webkit-box-shadow: inset 0px 1px 8px 3px #ABABAB,5px 5px 5px -100px #DDDDDD;
    -moz-box-shadow: inset 0px 1px 8px 3px #ABABAB,5px 5px 5px -100px #DDDDDD;
    -o-box-shadow: inset 0px 1px 8px 3px #ABABAB,5px 5px 5px -100px #DDDDDD;
    h1 {
        font-weight: bold;
        text-align: center;
    }
    img {
        max-width: 200px;
        border-radius: 20px;
    }

    .dish {
        width: 95%;
        margin: 0 auto;
        font-size: 14px;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 10px 15px -3px, rgba(0, 0, 0, 0.05) 0px 4px 6px -2px;
        h5 {
            font-size: 1rem;
        }
    }

    li{
        list-style: none;
    }
    
}
</style>