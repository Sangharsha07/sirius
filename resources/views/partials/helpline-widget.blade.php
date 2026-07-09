<style>
    .helpline-widget {
        position: fixed;
        right: 22px;
        bottom: 22px;
        z-index: 9999;
        width: 290px;
        font-family: Arial, Helvetica, sans-serif;
    }

    .helpline-widget details {
        background: rgba(255, 255, 255, 0.22);
        backdrop-filter: blur(18px);
        border-radius: 18px;
        box-shadow: 0 12px 35px rgba(15, 23, 42, 0.18);
        border: 1px solid rgba(255, 255, 255, 0.42);
        overflow: hidden;
    }

    .helpline-widget summary {
        cursor: pointer;
        list-style: none;
        padding: 13px 17px;
        color: white;
        font-weight: bold;
        background: rgba(79, 70, 229, 0.58);
        border-radius: 18px;
        text-shadow: 0 1px 5px rgba(0,0,0,0.25);
    }

    .helpline-widget summary::-webkit-details-marker {
        display: none;
    }

    .helpline-widget details[open] summary {
        border-radius: 18px 18px 0 0;
        background: rgba(79, 70, 229, 0.82);
    }

    .helpline-content {
        padding: 14px;
        font-size: 12px;
        color: white;
        line-height: 1.55;
        max-height: 230px;
        overflow-y: auto;
        background: rgba(15, 23, 42, 0.28);
    }

    .helpline-content strong {
        color: #fff7ba;
    }

    .helpline-content a {
        color: white;
        font-weight: bold;
        text-decoration: underline;
    }

    .resources-link {
        display: block;
        margin-top: 12px;
        background: rgba(255,255,255,0.88);
        color: #3730a3 !important;
        text-align: center;
        padding: 10px;
        border-radius: 12px;
        text-decoration: none !important;
    }

    .resources-link:hover {
        background: white;
    }

    @media (max-width: 700px) {
        .helpline-widget {
            left: 12px;
            right: 12px;
            bottom: 12px;
            width: auto;
        }
    }
</style>

<div class="helpline-widget">
    <details>
        <summary>💙 Need support?</summary>

        <div class="helpline-content">
            <p><strong>TUJ Counseling:</strong><br>
                <a href="mailto:tujcounseling@tuj.temple.edu">tujcounseling@tuj.temple.edu</a>
            </p>

            <br>

            <p><strong>TUJ TELUS JA Students:</strong><br>
                <a href="tel:08002221148">0800-222-1148</a>
            </p>

            <br>

            <p><strong>TELL English Lifeline:</strong><br>
                <a href="tel:08003008355">0800-300-8355</a>
            </p>

            <br>

            <p><strong>Yorisoi Hotline Japan:</strong><br>
                <a href="tel:0120279338">0120-279-338</a>
            </p>

            <br>

            <p><strong>Emergency Japan:</strong><br>
                Ambulance: <a href="tel:119">119</a><br>
                Police: <a href="tel:110">110</a>
            </p>

            <a href="{{ route('resources') }}" class="resources-link">
                Open Resources →
            </a>
        </div>
    </details>
</div>