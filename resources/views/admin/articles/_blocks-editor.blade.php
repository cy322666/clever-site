@php
    $initialBlocks = old('content_blocks_payload')
        ? (json_decode((string) old('content_blocks_payload'), true) ?: [])
        : $article->editorContentBlocks();
@endphp

<div
    class="space-y-4"
    data-article-block-editor
    data-initial-blocks='@json($initialBlocks, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)'
>
    <div class="flex flex-col gap-2 md:flex-row md:items-center md:justify-between">
        <div>
            <h2 class="text-base font-semibold text-slate-900">Блоки статьи</h2>
            <p class="text-sm text-slate-500">Основной формат хранения статьи. Публичная страница рендерится именно из этих блоков</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <button type="button" class="btn btn-secondary" data-add-block="heading">Заголовок</button>
            <button type="button" class="btn btn-secondary" data-add-block="paragraph">Абзац</button>
            <button type="button" class="btn btn-secondary" data-add-block="list">Список</button>
            <button type="button" class="btn btn-secondary" data-add-block="quote">Цитата</button>
            <button type="button" class="btn btn-secondary" data-add-block="cta">CTA</button>
            <button type="button" class="btn btn-secondary" data-add-block="image">Изображение</button>
            <button type="button" class="btn btn-secondary" data-add-block="links">Ссылки</button>
        </div>
    </div>

    <div class="space-y-4" data-block-list></div>

    <textarea name="content_blocks_payload" hidden data-block-payload>{{ old('content_blocks_payload') }}</textarea>

    <template data-block-template>
        <article class="rounded-2xl border border-slate-200 bg-slate-50 p-4" data-block-item>
            <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                <div class="flex items-center gap-3">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-slate-900 text-xs font-semibold text-white" data-block-index>1</span>
                    <select class="rounded-md border border-slate-300 bg-white px-3 py-2 text-sm" data-block-type>
                        <option value="heading">heading</option>
                        <option value="paragraph">paragraph</option>
                        <option value="list">list</option>
                        <option value="quote">quote</option>
                        <option value="cta">cta</option>
                        <option value="image">image</option>
                        <option value="links">links</option>
                    </select>
                </div>
                <div class="flex flex-wrap gap-2">
                    <button type="button" class="btn btn-secondary" data-move-up>Вверх</button>
                    <button type="button" class="btn btn-secondary" data-move-down>Вниз</button>
                    <button type="button" class="btn btn-danger" data-remove-block>Удалить</button>
                </div>
            </div>

            <div class="mt-4 space-y-4" data-block-fields></div>
        </article>
    </template>

    <template data-empty-state>
        <div class="rounded-2xl border border-dashed border-slate-300 bg-white px-4 py-6 text-sm text-slate-500">
            Блоков пока нет. Добавьте хотя бы заголовок и несколько абзацев
        </div>
    </template>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('[data-article-block-editor]').forEach((editor) => {
            const list = editor.querySelector('[data-block-list]');
            const payloadInput = editor.querySelector('[data-block-payload]');
            const template = editor.querySelector('[data-block-template]');
            const emptyTemplate = editor.querySelector('[data-empty-state]');

            const defaultBlockByType = {
                heading: { type: 'heading', text: '', level: 2 },
                paragraph: { type: 'paragraph', text: '' },
                list: { type: 'list', style: 'unordered', items: [''] },
                quote: { type: 'quote', text: '', author: '' },
                cta: { type: 'cta', title: '', text: '', button_label: '', button_url: '' },
                image: { type: 'image', image_url: '', alt: '', caption: '' },
                links: { type: 'links', title: '', items: [{ url: '', title: '', badge: '', description: '' }] },
            };

            let blocks = [];

            try {
                blocks = JSON.parse(editor.dataset.initialBlocks || '[]') || [];
            } catch (error) {
                blocks = [];
            }

            const escapeHtml = (value) => String(value ?? '')
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');

            const setDefaultBlock = (type) => JSON.parse(JSON.stringify(defaultBlockByType[type] || defaultBlockByType.paragraph));

            const blockFieldsMarkup = (block) => {
                switch (block.type) {
                    case 'heading':
                        return `
                            <div class="grid gap-4 md:grid-cols-[1fr_160px]">
                                <div class="space-y-2">
                                    <label class="text-sm font-medium text-slate-700">Текст заголовка</label>
                                    <input type="text" data-field="text" value="${escapeHtml(block.text)}" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-sm font-medium text-slate-700">Уровень</label>
                                    <select data-field="level" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm">
                                        <option value="2" ${String(block.level ?? 2) === '2' ? 'selected' : ''}>H2</option>
                                        <option value="3" ${String(block.level ?? 2) === '3' ? 'selected' : ''}>H3</option>
                                    </select>
                                </div>
                            </div>
                        `;
                    case 'paragraph':
                        return `
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-slate-700">Текст абзаца</label>
                                <textarea rows="6" data-field="text" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm">${escapeHtml(block.text)}</textarea>
                            </div>
                        `;
                    case 'list':
                        return `
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-slate-700">Тип списка</label>
                                <select data-field="style" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm">
                                    <option value="unordered" ${block.style === 'unordered' ? 'selected' : ''}>Маркированный</option>
                                    <option value="ordered" ${block.style === 'ordered' ? 'selected' : ''}>Нумерованный</option>
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-slate-700">Пункты списка</label>
                                <textarea rows="5" data-field="items" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm">${escapeHtml((block.items || []).join("\n"))}</textarea>
                                <p class="text-xs text-slate-500">Один пункт на строку</p>
                            </div>
                        `;
                    case 'quote':
                        return `
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-slate-700">Текст цитаты</label>
                                <textarea rows="4" data-field="text" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm">${escapeHtml(block.text)}</textarea>
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-slate-700">Автор</label>
                                <input type="text" data-field="author" value="${escapeHtml(block.author)}" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm">
                            </div>
                        `;
                    case 'cta':
                        return `
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-slate-700">Заголовок CTA</label>
                                <input type="text" data-field="title" value="${escapeHtml(block.title)}" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm">
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-slate-700">Текст</label>
                                <textarea rows="4" data-field="text" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm">${escapeHtml(block.text)}</textarea>
                            </div>
                            <div class="grid gap-4 md:grid-cols-2">
                                <div class="space-y-2">
                                    <label class="text-sm font-medium text-slate-700">Текст кнопки</label>
                                    <input type="text" data-field="button_label" value="${escapeHtml(block.button_label)}" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-sm font-medium text-slate-700">URL кнопки</label>
                                    <input type="text" data-field="button_url" value="${escapeHtml(block.button_url)}" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm">
                                </div>
                            </div>
                        `;
                    case 'image':
                        return `
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-slate-700">URL изображения</label>
                                <input type="text" data-field="image_url" value="${escapeHtml(block.image_url)}" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm">
                            </div>
                            <div class="grid gap-4 md:grid-cols-2">
                                <div class="space-y-2">
                                    <label class="text-sm font-medium text-slate-700">Alt</label>
                                    <input type="text" data-field="alt" value="${escapeHtml(block.alt)}" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-sm font-medium text-slate-700">Подпись</label>
                                    <input type="text" data-field="caption" value="${escapeHtml(block.caption)}" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm">
                                </div>
                            </div>
                        `;
                    case 'links':
                        return `
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-slate-700">Заголовок блока ссылок</label>
                                <input type="text" data-field="title" value="${escapeHtml(block.title)}" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm">
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-slate-700">Ссылки</label>
                                <textarea rows="8" data-field="items" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm">${escapeHtml((block.items || []).map((item) => {
                                    if (typeof item === 'string') return item;
                                    return [item.url || '', item.title || '', item.badge || '', item.description || ''].join(' | ');
                                }).join("\n"))}</textarea>
                                <p class="text-xs text-slate-500">Одна ссылка на строку. Формат: URL | Заголовок | Бейдж | Описание. Можно оставить только URL</p>
                            </div>
                        `;
                    default:
                        return '';
                }
            };

            const normalizeBlockFromFields = (block) => {
                if (block.type === 'list') {
                    return {
                        ...block,
                        items: String(block.items || '')
                            .split('\n')
                            .map((item) => item.trim())
                            .filter(Boolean),
                    };
                }

                if (block.type === 'links') {
                    return {
                        ...block,
                        items: String(block.items || '')
                            .split('\n')
                            .map((line) => line.trim())
                            .filter(Boolean)
                            .map((line) => {
                                const parts = line.split('|').map((part) => part.trim());

                                if (parts.length === 1) {
                                    return { url: parts[0] };
                                }

                                return {
                                    url: parts[0] || '',
                                    title: parts[1] || '',
                                    badge: parts[2] || '',
                                    description: parts[3] || '',
                                };
                            }),
                    };
                }

                return block;
            };

            const persist = () => {
                payloadInput.value = JSON.stringify(blocks.map(normalizeBlockFromFields));
            };

            const render = () => {
                list.innerHTML = '';

                if (blocks.length === 0) {
                    list.append(emptyTemplate.content.cloneNode(true));
                    persist();
                    return;
                }

                blocks.forEach((block, index) => {
                    const fragment = template.content.cloneNode(true);
                    const item = fragment.querySelector('[data-block-item]');
                    const typeSelect = fragment.querySelector('[data-block-type]');
                    const indexNode = fragment.querySelector('[data-block-index]');
                    const fieldsWrap = fragment.querySelector('[data-block-fields]');

                    indexNode.textContent = String(index + 1).padStart(2, '0');
                    typeSelect.value = block.type;
                    fieldsWrap.innerHTML = blockFieldsMarkup(block);

                    typeSelect.addEventListener('change', (event) => {
                        blocks[index] = setDefaultBlock(event.target.value);
                        render();
                    });

                    fieldsWrap.querySelectorAll('[data-field]').forEach((field) => {
                        field.addEventListener('input', () => {
                            const key = field.dataset.field;
                            blocks[index][key] = field.value;
                            persist();
                        });
                    });

                    item.querySelector('[data-remove-block]').addEventListener('click', () => {
                        blocks.splice(index, 1);
                        render();
                    });

                    item.querySelector('[data-move-up]').addEventListener('click', () => {
                        if (index === 0) return;
                        [blocks[index - 1], blocks[index]] = [blocks[index], blocks[index - 1]];
                        render();
                    });

                    item.querySelector('[data-move-down]').addEventListener('click', () => {
                        if (index === blocks.length - 1) return;
                        [blocks[index + 1], blocks[index]] = [blocks[index], blocks[index + 1]];
                        render();
                    });

                    list.append(fragment);
                });

                persist();
            };

            editor.querySelectorAll('[data-add-block]').forEach((button) => {
                button.addEventListener('click', () => {
                    blocks.push(setDefaultBlock(button.dataset.addBlock));
                    render();
                });
            });

            render();
        });
    });
</script>
