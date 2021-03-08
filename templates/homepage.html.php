<div class="container p-4 bg-white mt-3">
    <h1>Benvenuto nel REST Web Service!</h1>
    <hr />
    <p>Questo sito contiene dati per il <strong>noleggio auto</strong>.</p>
    <p>Qui una lista delle informazioni che potete ottenere:</p>
    <ul>
        <li><strong>Auto</strong></li>
        <li><strong>Noleggi</strong></li>
    </ul>
    <h3>Come richiede le informazioni</h3>
    <hr />
    <p>Per richiedere le informazioni potete usare le url:</p>
    <ul>
        <li><strong>/api/(auto|noleggi)/list</strong>: riceverete come risposta un json contenente la lista di tutti i valori</li>
        <li><strong>/api/(auto|noleggi)/(targa|id)</strong>: otterrete come risposta un json contenete il valore richiesto</li>
    </ul>
    <h3>Un esempio</h3>
    <hr />
    <h5 class="mt-4 mb-4"><strong>Voglio avere una lista di tutte le auto.</strong></h5>
    <p>La URL sar&agrave;:</p>
    <pre><?=$server_name;?>/api/auto/list</pre>
    <p>e il risultato sar&agrave;:</p>
    <iframe src="/api/auto/list" width="100%" height="256px"></iframe>
    <h5 class="mt-4 mb-4"><strong>Voglio avere informazioni sull'auto con targa VJ646BB.</strong></h5>
    <p>La URL sar&agrave;:</p>
    <pre><?=$server_name;?>/api/auto/VJ646BB</pre>
    <p>e il risultato sar&agrave;:</p>
    <iframe src="/api/auto/VJ646BB" width="100%"></iframe>
    <h3>Aggiungere informazioni</h3>
    <hr />
    <h5 class="mt-4 mb-4"><strong>Posso cambiare il tipo di formato restituito?</strong></h5>
    <p>Potete decidere voi il tipo di formato.</p>
    <p>Basta aggiungere all'url questa query string:</p>
    <pre>?format=(json|xml|html)</pre>
    <p>Ovviamente è accettato un solo formato tra questi 3</p>
</div>