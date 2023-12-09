# Bu kod, bir Streamlit uygulamasında kullanılmak üzere,
# önceden eğitilmiş bir kitap öneri sistemi modelini ve diğer
# ilgili verileri yüklemek için pickle modülünü kullanıyor.
import pickle
import streamlit as st
import numpy as np
import webbrowser

url = "http://localhost/kitabimm/index.php"
if st.button("Ana Sayfa"):
    webbrowser.open_new_tab(url)

st.header(
    "Kitap Tavsiye Sayfası"
)  # Streamlit uygulamasının başlığını oluşturmak için st.header() fonksiyonu kullanılıyor.
# model.pkl dosyası,önerileri oluşturmak için kullanılan eğitilmiş makine öğrenimi modelini içerir.
model = pickle.load(open("artifacts/model.pkl", "rb"))
# book_names.pkl dosyası, olası kitapların adlarının listesini içerir. Bu dosya muhtemelen, book_pivot.pkl
# dosyasındaki sütunlara karşılık gelen kitap adlarını sağlamak için kullanılır.
book_names = pickle.load(open("artifacts/books_name.pkl", "rb"))
# final_rating.pkl dosyası, kitapların önerileri için son derece değerli olan final puanları içerir.
final_rating = pickle.load(open("artifacts/final_rating.pkl", "rb"))
# book_pivot.pkl dosyası, kitaplar hakkında farklı özellikleri içeren bir veri çerçevesidir. Bu dosya,
# model.pkl dosyasını kullanarak kitap önerileri oluşturmak için kullanılır.
book_pivot = pickle.load(open("artifacts/book_pivot.pkl", "rb"))


# fecth_poster fonksiyonu, önerilen kitapların afişlerini elde etmek için kullanılır.
#  Bu fonksiyon, suggestion listesindeki her kitap için kitap adını,
#  o kitabın final_rating veri çerçevesindeki dizinini ve son olarak kitabın afiş URL'sini alır.
def fecth_poster(suggestion):
    book_name = []
    ids_index = []
    poster_url = []

    for book_id in suggestion:
        book_name.append(book_pivot.index[book_id])

    for name in book_name[0]:
        ids = np.where(final_rating["title"] == name)[0][0]
        ids_index.append(ids)

    for idx in ids_index:
        url = final_rating.iloc[idx]["img_url"]
        poster_url.append(url)

    return poster_url


# recommend_book fonksiyonu, seçilen kitaba dayalı olarak önerilen kitapları almak için kullanılır. Bu fonksiyon,
#  seçilen kitabın book_pivot veri çerçevesindeki dizinini alır,
#  model kullanarak benzer kitapları bulur ve bu kitapların adlarını
# ve afişlerini fecth_poster fonksiyonunu kullanarak döndürür.
def recommend_book(book_name):
    books_list = []

    book_id = np.where(book_pivot.index == book_name)[0][0]

    distance, suggestion = model.kneighbors(
        book_pivot.iloc[book_id, :].values.reshape(1, -1), n_neighbors=7
    )

    poster_url = fecth_poster(suggestion)

    for i in range(len(suggestion)):
        books = book_pivot.index[suggestion[i]]
        for j in books:
            books_list.append(j)
    return books_list, poster_url


# selected_books değişkeni, Streamlit uygulamasındaki kullanıcı arayüzüne bir seçim kutusu ekler.
#  Bu kutuda, önerileri görmek için bir kitap seçebilirsiniz.
selected_books = st.selectbox("Açılır listeden bir kitap yazın veya seçin", book_names)

# if st.button satırı, "Show Recommendation" düğmesine basıldığında önerilen kitapları görüntülemek için kullanılır.
# Bu satır, recommend_book fonksiyonunu kullanarak önerilen kitapları alır
# ve ardından st.image ve st.text Streamlit işlevlerini kullanarak önerilen kitapların adlarını ve afişlerini görüntüler.
if st.button("Öneriyi Göster"):
    recommended_books, poster_url = recommend_book(selected_books)

    col1, col2, col3, col4, col5 = st.columns(5)
    with col1:
        st.text(recommended_books[1])
        st.image(poster_url[1])
    with col2:
        st.text(recommended_books[2])
        st.image(poster_url[2])

    with col3:
        st.text(recommended_books[3])
        st.image(poster_url[3])

    with col4:
        st.text(recommended_books[4])
        st.image(poster_url[4])
    with col5:
        st.text(recommended_books[5])
        st.image(poster_url[5])
