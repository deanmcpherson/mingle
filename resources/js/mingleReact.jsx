import React, {useEffect, useState} from 'react'
import {createRoot} from 'react-dom/client'

const MingleComponent = ({wire, wireId, Component, mingleData}) => {

    const [_, reRenderOnUpdate] = useState(0);
    useEffect(() => {
        Livewire.hook('morph.updated', ({ el, component }) => {
            if (component.id === wireId) {
                reRenderOnUpdate(n => n+1);
            }
        })
    }, []);
    return <Component wire={wire} wireId={wireId} mingleData={mingleData} />
}

const createComponent = (mingleId, wireId, Component) => {

    const
        el = document.getElementById(mingleId),
        wire = window.Livewire.find(wireId)

    if (! el) {
        throw new Error(`Element for type '${Component}' with id '${mingleId}' not found.`)
    }

    el.dataset.reactApp = 'true'

    const root = createRoot(el)

    root.render(<MingleComponent wire={wire} wireId={wireId}  Component={Component}  mingleData={JSON.parse(el.dataset.mingleData)} />)
}

const registerReactMingle = (name, component) => {
    window.Mingle = window.Mingle || {
        Elements: {}
    }

    window.Mingle.Elements[name] = {
        boot(mingleId, wireId) {
            createComponent(mingleId, wireId, component)
        }
    }
}

export default registerReactMingle
