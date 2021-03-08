<div class="container p-4 bg-white mt-3">
    <h1>Benvenuto nel REST Web Service!</h1>
    <hr />
    <p>Questo sito contiene dati per il <strong>noleggio auto</strong>.</p>
    <p>Qui una lista delle informazioni che potete ottenere:</p>
    <ul>
        <li><strong>Observation</strong></li>
    </ul>
    <h3>Come richiede le informazioni</h3>
    <hr />
    <p>Per richiedere le informazioni potete usare le url:</p>
    <ul>
        <li><strong>/api/(observation)/list</strong>: riceverete come risposta un json contenente la lista di tutti i valori</li>
        <li><strong>/api/(observation)/(time)</strong>: otterrete come risposta un json contenete il valore richiesto</li>
    </ul>
    <h3 class="mt-4 mb-4">Aggiungere informazioni</h3>
    <hr />
    <h5 class="mt-4 mb-4"><strong>Posso cambiare il tipo di formato restituito?</strong></h5>
    <p>Potete decidere voi il tipo di formato.</p>
    <p>Basta aggiungere all'url questa query string:</p>
    <pre>?format=(json|xml|html)</pre>
    <p>Ovviamente è accettato un solo formato tra questi 3</p>
</div>